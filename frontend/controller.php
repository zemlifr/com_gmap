<?php

// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');
 
class GmapController extends JController
{
    
   function __construct()
   {
       parent::__construct();
       $this->registerTask('mapData','mapData');
       
   }
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
        parent::display();
    }
    
    function mapData()
   {
       $doc =& JFactory::getDocument();
       $doc->setMimeEncoding('text/xml');
       $model = $this->getModel('gmap');
       $dom =& $model->createDom();
       
       echo $dom->saveXML();

   }
   
 
}
