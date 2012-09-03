<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
jimport( 'joomla.filesystem.folder' );

class GmapModelSet extends JModel
{  
    private $data;
    private $id;
    
    function __construct()
    {
	parent::__construct();
	$cid = JRequest::getVar('cid',  0, '', 'array');
	$this->id = (int)($cid[0]);
        $this->data = null;
    }
    
    function &getData()
    {
      $this->data = null;
      $db =& JFactory::getDBO();
      $query = "SELECT * FROM #__gmap_sets WHERE id=".$this->id;
      $db->setQuery($query);
      $this->data = $db->loadObject();
      
      if(!$this->data)
          $this->data = new stdClass();

      
      return $this->data;
    }
    
    function hasMarkers($id)
    {
        $query = "SELECT COUNT(*) FROM #__gmap_markers WHERE set_id=".$id;
        $this->_db->setQuery( $query );
        
        $result = $this->_db->loadResult();
        
        if($result)
            return true;
        return false;
    }
    
    function Store()
    {   
      $row =& $this->getTable('set');
      $data = JRequest::get( 'post' );
      
      // Bind the form fields to the table
      if (!$row->bind($data)) {
        $this->setError($this->_db->getErrorMsg());
        return false;
      }
      
      // Store table data to the database
      if (!$row->store()) {
        $this->setError($this->_db->getErrorMsg());
        return false;
      }
 
      return true;
    }
    
    function delete()
    {
      $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
      $row =& $this->getTable();
 
      foreach($cids as $cid)
      {
        if($this->hasMarkers($cid))
        {
            $this->setError("Can't remove non-empty set.");
            return false;
        }          
        if(!$row->delete( $cid ))
        {
            $this->setError( $row->getError());
            return false;
        }
      }
 

      return true;
    }
    

    function publishList($val = 1)
    {
         $cid = JRequest::getVar( 'cid', array(0), 'post', 'array' );
         if (count( $cid ))
         {
             JArrayHelper::toInteger($cid);
             $cids = implode( ',', $cid );
             $query = 'UPDATE #__gmap_sets'. ' SET published = '.$val. ' WHERE id IN ( '.$cids.' )';
             $this->_db->setQuery( $query );
             
             if (!$this->_db->query())
                {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
           }
           return true;
    }
    
    function getIconList( $name, $extensions =  "bmp|gif|jpg|png" )
{
        $directory = "media".DS."com_gmap";
        
        jimport( 'joomla.filesystem.folder' );
        $imageFiles = JFolder::files( JPATH_SITE.DS.$directory );
        $images = array();
        foreach ( $imageFiles as $file ) {
           if ( preg_match( "#$extensions#i", $file ) ) {
                        $images[] = $file;
                }
        }
 
        return $images;

    }

}

?>