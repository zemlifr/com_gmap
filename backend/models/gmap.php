<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
jimport('joomla.html.pagination');

class GmapModelGmap extends JModel
{   
    function __construct()
    {
	parent::__construct();
        
        $app = JFactory::getApplication();
        
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
	    $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
	    // In case limit has been changed, adjust it
	    $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
	    $this->setState('limit', $limit);
	    $this->setState('limitstart', $limitstart);
    }
    
    function &getMarkersList()
    {
      $this->data = null;
      $db =& JFactory::getDBO();
      $query = "SELECT m.title AS title, m.published AS published,".
               "m.latitude AS latitude, m.longitude AS longitude,".
               "m.id AS id, s.title AS stitle FROM #__gmap_markers m".
              " INNER JOIN #__gmap_sets s ON m.set_id = s.id LIMIT ".$this->getState('limit')." OFFSET ".$this->getState('limitstart');
      $db->setQuery($query);
      $this->data = $db->loadObjectList();

      
      return $this->data;
    }
    
      function getRecordCount()
    {
      $db =& JFactory::getDBO();
      $query = "SELECT COUNT(*) FROM #__gmap_markers";
      $db->setQuery($query);
      $this->recordCount = $db->loadResult();
      
      return $this->recordCount;
    }
    
    function getPagination()
    {
 	    // Load the content if it doesn't already exist
 	    if (empty($this->pagination)) {
 	      $this->pagination = new JPagination($this->getRecordCount(), $this->getState('limitstart'), $this->getState('limit') );
 	    }
 	    return $this->pagination;
    }

}

?>
