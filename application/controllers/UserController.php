<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		
    }

    public function logoutAction()
    {
        Zend_auth::getInstance()->clearIdentity();
		$this->_redirect();
    }


}



