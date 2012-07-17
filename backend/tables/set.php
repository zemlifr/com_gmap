<?php

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableSet extends JTable
{
    var $id = null;
    var $title = null;
    var $description = null;
    var $icon = null;
    var $published = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct(& $db)
    {
	parent::__construct('#__gmap_sets', 'id', $db);
    }

}

?>
