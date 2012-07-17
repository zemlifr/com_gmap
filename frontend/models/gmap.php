<?php
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.model' );
 
/*
 * Thanks to https://developers.google.com/maps/articles/phpsqlajax_v3 tutorial.
 */

class GmapModelGmap extends JModel
{
    function getSets()
    {
      $db =& JFactory::getDBO();
      $query = "SELECT * FROM #__gmap_sets WHERE published = 1";
      $db->setQuery($query);
      $result=$db->loadObjectList();
      
      return $result;
    }
    
    function getMarkers()
    {
      $db =& JFactory::getDBO();
      $query ="SELECT *,s.title AS stitle, m.title AS mtitle FROM #__gmap_markers m INNER JOIN #__gmap_sets s".
              " ON set_id = s.id WHERE m.published =1 AND s.published =1 ORDER BY set_id";
      $db->setQuery($query);
      $result=$db->loadObjectList();
      return $result;
    }
    
    
    function createDom()
    {
        //load data
        
        $data = $this->getMarkers();
        
        //start xml
        $dom = new DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node); 
        
        
        // Iterate through the rows, adding XML nodes for each
        foreach($data as $marker)
        {  
         $node = $dom->createElement("marker",$marker->text);  
         $newnode = $parnode->appendChild($node);
         
         $newnode->setAttribute("title",$marker->mtitle);
         $newnode->setAttribute("lat", $marker->latitude);  
         $newnode->setAttribute("lng", $marker->longitude);
         $newnode->setAttribute("set", $marker->set_id);
         $newnode->setAttribute("lng",   $marker->longitude);
         $newnode->setAttribute("icon",   $marker->icon);
        }
        
        return $dom;
    }
}