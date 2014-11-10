<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      
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
				$password = md5($form->getValue("_contrasenia"));

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

    public function cuentaAction()
    {
        // action body
    }

    public function aboutAction()
    {
        // action body
    }

    public function contactameAction()
    {
        // action body
    }

    public function modificarAction()
    {
        $name = $this->_getParam('nombre' ,' ');
		
		$infoDao = new App_Dao_InformacionDao();
		
		if($this->_request->getPost()) {
			$formaData = $this->_request->getPost();
			$form = new App_Form_ModificarForm();
			
			if($form->isValid($formData)) {
				$informacion = $infoDao->getPorNombre($name);
				$informacion->setDescripcion($formaData['_nombre']);
				$infoDao->guardar($informacion);
			}
			else {
				$form->populate($formaData);
			}
		} else{
			$name = $this->_getParam('nombre', '');
			
			if(empty($name)) {
				$this->redirect($url);
				return;
			}
			else {
				$form = App_Form_ModificarForm();
			}
		}
			
        //$id = $this->_getParam('id');
		/*$nombre = $this->_getParam('nombre');
        $form = new App_Form_ModificarForm();
        if(empty($nombre))
            $this->_helper->redirector('index');
        $infoDao = new App_Dao_InfoDao();
        
        if ($this->_request->getPost()) {
		$formData = $this->_request->getPost();

		if ($form->isValid($formData)) {
		//$especialidad = new App_Model_Especialidad();
		$info = $infoDao->getPorNombre($nombre);
		//Zend_Debug::dump($info); die;
		$info->setDescripcion($formData['_descripcion']);
				
		$infoDao = new App_Dao_InfoDao();
		$infoDao->guardar($info);
		
		//$especialidad = $especialidadDao->getEspecialidadPorId($id);		
		//$especialidad->setNombre($formData['_nombre']);
		//$especialidad->setTipo($formData['_tipo']);
				/*if($formData['_descripcion']){
					$especialidad->setDescription($formData['_descripcion']);
				}
				
		//$especialidadDao = new App_Dao_EspecialidadDao();		$especialidadDao->guardar($especialidad);
		//$this->_helper->redirector('index');
		//return;
			
            }
            else 
                $form->populate($formData);
	}else{
                $id = $this->_getParam('nombre');
                if (empty($nombre)) {
                    //$this->_helper->redirector('index');
                    //return;
                } else
                $form = new App_Form_ModificarForm(); 
            }
            //$especialidad = $especialidadDao->getEspecialidadPorId($id);
            $info = $infoDao->getPorNombre($nombre);
            if (!empty($especialidad))
            $form->populate($info->toArray());
            $this->view->form = $form;*/
            //$this->view->especialidades = $especialidadDao->getTodos();  
    }

    public function campaniaAction()
    {
        // action body
    }

    public function destacadosAction()
    {
        // action body
    }

    public function otrosAction()
    {
        // action body
    }

    public function logoutAction()
    {
        // action body
        Zend_Auth::getInstance()->clearIdentity();		
		$this->_redirect();
    }


}



















