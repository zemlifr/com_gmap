<?php


// no direct access


defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.application.component.view');


class GmapViewGmap extends JView

{

    function display($tpl = null)

    {

        JToolBarHelper::title('Google map','');
        JToolBarHelper::publishList();
	      JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        $model =& $this->getModel();

        $markers = $model->getMarkersList();
        $pagination =& $this->get('Pagination');
        
        $this->assignRef('markers', $markers);
        $this->assignRef('pagination', $pagination);

        parent::display($tpl);

    }

}
