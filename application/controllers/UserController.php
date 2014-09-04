<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $ceci = new App_Model_User();
		$ceci->setApellido("Chalar");
		$ceci->setNombre("Cecilia");
		
		$this->view->ceci = $ceci; 
		
    }


}

