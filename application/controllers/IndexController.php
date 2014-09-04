<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $a = 2 + 4;
		
		$this->view->a = $a;
    }


}

