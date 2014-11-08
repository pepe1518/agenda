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

    public function agregarAction()
    {
		//$id = Zend_Auth::getInstance()->getIdentity()->getId();
		$form = new App_Form_UserForm();
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
								
				
				$user = new App_Model_User();
				
				
				$user->setUsusario($formData['_usuario']);
				$user->setContrasenia($formData['_contrasenia']);
				$user->setNombre($formData['_nombre']);
				$user->setApellido($formData['_apellido']);
				
				
				$userDao = new App_Dao_UserDao();
				$userDao->guardar($user);				
				
				$this->_helper->redirector('index');
				return;
			}
		}
		$this->view->form = $form;
    }

    public function logoutAction()
    {
        Zend_auth::getInstance()->clearIdentity();		
		//$this->_redirect();
    }

    public function aboutAction()
    {
        // action body
    }


}







