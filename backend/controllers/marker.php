<?php
// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class GmapControllerMarker extends GmapController
{

    function __construct()
    {
	parent::__construct();
        $this->registerTask( 'add', 'edit' );
    }

    function edit()
    {
        JRequest::setVar( 'view', 'marker' );
        JRequest::setVar( 'layout', 'form'  );
        JRequest::setVar('hidemainmenu', 1);
 
        parent::display();           
    }

    function display()
    {
        parent::display();
    }
    
    function save()
    {
      $model = $this->getModel('marker');
 
      if ($model->Store()) {
        $msg = JText::_( 'Marker saved successfully' );
      } else {
        $msg = JText::_( 'Error' ).$model->getError();
      }
 
      $this->setRedirect('index.php?option=com_gmap', $msg);
    }
    
    function remove()
    {
      $model = $this->getModel('marker');
      if(!$model->delete()) {
        $msg = JText::_( 'Error: Some Markers could\'nt be deleted!' );
      } else {
        $msg = JText::_( 'Markers deleted.' );
      }
 
      $this->setRedirect( 'index.php?option=com_gmap', $msg );
    }
    
    function cancel()
    {
      $msg = JText::_( 'Operation cancelled' );
      $this->setRedirect( 'index.php?option=com_gmap', $msg );
    }
    
    function publish() 
    { 
      $model = & $this->getModel('marker');
      $model->publishList(1);

      $this->setRedirect('index.php?option=com_gmap');
    }
    
    function unpublish()
    {
      $model = $this->getModel('marker');
      $model->publishList(0);
           
      $this->setRedirect('index.php?option=com_gmap');
    }
  
}
