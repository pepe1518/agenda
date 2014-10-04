<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       $form = new App_Form_LoginForm();
		$this->view->form = $form;
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect();
		}

		if ($this->getRequest()->isPost()) {
			if ($form->isValid($_POST)) {
				$nombreUsuario = $form->getValue("_usuario");
				$password = $form->getValue("_contrasenia");

				$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'user', 'usuario', 'contrasenia');
				$authAdapter->setIdentityColumn('usuario')->setCredentialColumn('contrasenia');
				$authAdapter->setIdentity($nombreUsuario)->setCredential($password);
                                
				
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if ($result->isValid()) {
					$storage = $auth->getStorage();
					//Aqui se guarda el objeto de session
					$userDao = new App_Dao_UserDao();
					$usuarioAuthenticado = $userDao->getPorUsuarioContrasenia($nombreUsuario, $password);
					$storage->write($usuarioAuthenticado);
					$this->_redirect('/user/index');
				} else {
					$this->view->errorMessage = "Invalid username or password. Please try again.";
				}
			}
    	}
    }

    public function loginAction()
    {
        $form = new App_Form_LoginForm();
		$this->view->form = $form;
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect();
		}

		if ($this->getRequest()->isPost()) {
			if ($form->isValid($_POST)) {
				$nombreUsuario = $form->getValue("_usuario");
				$password = $form->getValue("_contrasenia");

				$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'user', 'usuario', 'contrasenia');
				$authAdapter->setIdentityColumn('usuario')->setCredentialColumn('contrasenia');
				$authAdapter->setIdentity($nombreUsuario)->setCredential($password);
                                
				
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if ($result->isValid()) {
					$storage = $auth->getStorage();
					//Aqui se guarda el objeto de session
					$userDao = new App_Dao_UserDao();
					$usuarioAuthenticado = $userDao->getPorUsuarioContrasenia($nombreUsuario, $password);
					$storage->write($usuarioAuthenticado);
					$this->_redirect('/user/index');
				} else {
					$this->view->errorMessage = "Invalid username or password. Please try again.";
				}
			}
    	}
    }


}



