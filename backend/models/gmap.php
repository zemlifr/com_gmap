<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class GmapModelGmap extends JModel
{   
    function __construct()
    {
	parent::__construct();
    }
    
    function &getMarkersList()
    {
      $this->data = null;
      $db =& JFactory::getDBO();
      $query = "SELECT m.title AS title, m.published AS published,".
               "m.latitude AS latitude, m.longitude AS longitude,".
               "m.id AS id, s.title AS stitle FROM #__gmap_markers m".
              " INNER JOIN #__gmap_sets s ON m.set_id = s.id";
      $db->setQuery($query);
      $this->data = $db->loadObjectList();

      
      return $this->data;
    }    

}

?>
