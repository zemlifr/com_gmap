<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );


class GmapModelSets extends JModel
{
    
    function __construct()
    {
	parent::__construct();
    }
    
    
    function getSetsList()
    {
      $db =& JFactory::getDBO();
      $query ="SELECT * FROM #__gmap_sets";
      $db->setQuery($query);
      $result=$db->loadObjectList();
      
      return $result;
        
    }

}

?>