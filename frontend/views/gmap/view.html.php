<?php

// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
 
class GmapViewGmap extends JView
{
    function display($tpl = null)
    {
        $model =& $this->getModel('gmap');
        $sets =& $model->getSets();
        
        $this->assignRef('sets', $sets);
        
        $document = JFactory::getDocument();
        $document->addScript('http://maps.google.com/maps/api/js?sensor=false');
        $document->addScript('components/com_gmap/gmap.js');
        
        parent::display($tpl);
    }
}