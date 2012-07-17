<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableMarker extends JTable
{
    var $id = null;
    var $title = null;
    var $text = null;
    var $longitude = null;
    var $latitude = null;
    var $set_id = null;
    var $published = null;
    
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function TableMarker(& $db)
    {
	parent::__construct('#__gmap_markers', 'id', $db);
    }

}

?>