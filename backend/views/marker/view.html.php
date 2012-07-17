<?php


// no direct access


defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.view');


class GmapViewMarker extends JView

{

    function display($tpl = null)
    {
        $document = JFactory::getDocument();
        $document->addScript('http://maps.google.com/maps/api/js?sensor=false');
        $document->addScript('/joomla15/administrator/components/com_gmap/gmap.js');
        
        JToolBarHelper::title('Google map','');
        JToolBarHelper::save();
        
        $marker =& $this->get('Data');
        $sets =& $this->get('Sets');
        
        
        if($marker->id<1)
          {
            JToolBarHelper::cancel();
          }
        else
          {
            JToolBarHelper::cancel( 'cancel', 'Close' );
          } 
        
           
        $this->assignRef('marker', $marker);
        $this->assignRef('sets', $sets);

        parent::display($tpl);

    }

}
