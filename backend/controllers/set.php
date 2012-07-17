<?php
// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class GmapControllerSet extends GmapController
{

    function __construct()
    {
	parent::__construct();
        $this->registerTask( 'add', 'edit' );
    }

    function edit()
    {
        JRequest::setVar( 'view', 'set' );
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
      $model = $this->getModel('set');
 
      if ($model->Store()) {
        $msg = JText::_( 'Set saved successfully' );
      } else {
        $msg = JText::_( 'Error' ).$model->getError();
      }
 
      $this->setRedirect('index.php?option=com_gmap&view=sets', $msg);
    }
    
    function remove()
    {
      $model = $this->getModel('set');
      if(!$model->delete())
      {
        $msg = JText::_( 'Error: Some Sets could\'nt be deleted! '.$model->GetError() );
        $type = "error";
      } 
      else
      {
        $msg = JText::_( 'Sets deleted.' );
        $type = "message";
      }
 
      $this->setRedirect( 'index.php?option=com_gmap&view=sets', $msg, $type );
    }
    
    function cancel()
    {
      $msg = JText::_( 'Operation cancelled' );
      $this->setRedirect( 'index.php?option=com_gmap&view=sets', $msg );
    }
    
    function publish() 
    { 
      $model = & $this->getModel('set');
      $model->publishList(1);

      $this->setRedirect('index.php?option=com_gmap&view=sets');
    }
    
    function unpublish()
    {
      $model = $this->getModel('set');
      $model->publishList(0);
           
      $this->setRedirect('index.php?option=com_gmap&view=sets');
    }
  
}
