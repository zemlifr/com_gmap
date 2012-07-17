<?php

// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Require the base controller
 
require_once( JPATH_COMPONENT.DS.'controller.php' );
JSubMenuHelper::addEntry(JText::_('Markers'), 'index.php?option=com_gmap'); 
JSubMenuHelper::addEntry(JText::_('Map sets'), 'index.php?option=com_gmap&view=sets');

// Require specific controller if requested
if($controller = JRequest::getVar('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once ($path);
    } else {
        $controller = '';
    }
}
 
// Create the controller
$classname    = 'GmapController'.$controller;
$controller   = new $classname( );
// Perform the Request task
$controller->execute( JRequest::getVar( 'task','display' ) );
 
// Redirect if set by the controller
$controller->redirect();   

