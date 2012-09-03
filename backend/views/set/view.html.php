<?php


// no direct access


defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.view');


class GmapViewSet extends JView
{

    function display($tpl = null)
    {

        JToolBarHelper::save();
        
        $model =& $this->getModel('set');
        $data =& $model->getData();
        $icons = $model->getIconList();
        
        if($data)
          {
            JToolBarHelper::title('Google map - <small>'.$data->title.'</small>','');
            JToolBarHelper::cancel();
          }
        else
          {
            JToolBarHelper::title('Google map - <small>New set</small>','');
            JToolBarHelper::cancel( 'cancel', 'Close' );
          } 
          
        $this->assignRef('data', $data);
        $this->assignRef('icons', $icons);

        parent::display($tpl);

    }

}
