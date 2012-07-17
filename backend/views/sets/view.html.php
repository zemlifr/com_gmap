<?php


// no direct access


defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.view');


class GmapViewSets extends JView

{

    function display($tpl = null)

    {

        JToolBarHelper::title('Google map','');
        JToolBarHelper::publishList();
	      JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();
        
        $model =& $this->getModel('sets');
        $data = $model->getSetsList();

        $this->assignRef('data', $data);

        parent::display($tpl);
            
    }

}
