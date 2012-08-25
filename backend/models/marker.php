<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class GmapModelMarker extends JModel
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
      $query = "SELECT * FROM #__gmap_markers WHERE id=".$this->id;
      $db->setQuery($query);
      $this->data = $db->loadObject();

      
      return $this->data;
    }
    
    function &getSets()
    {
      $sets = null;
      $db =& JFactory::getDBO();
      $query = "SELECT title, id FROM #__gmap_sets";
      $db->setQuery($query);
      $sets = $db->loadObjectList();
      
      return $sets;
    }
    
    function Store()
    {   
      $row =& $this->getTable();
      $data = JRequest::get( 'post', JREQUEST_ALLOWHTML );
      
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
 
      foreach($cids as $cid) {
        if ( !$row->delete( $cid )) {
            $this->setError( $row->getErrorMsg() );
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
             $query = 'UPDATE #__gmap_markers'. ' SET published = '.$val. ' WHERE id IN ( '.$cids.' )';
             $this->_db->setQuery( $query );
             
             if (!$this->_db->query())
                {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
           }
           return true;
    }
    

        

}

?>
