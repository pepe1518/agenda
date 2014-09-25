<?php

class ContactoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$page = $this->_getParam('page', 1);

		$userDao = new App_Dao_ContactoDao();
		$paginator = new App_Util_Paginator($this->getRequest()->getBaseUrl() . '/contacto/index', $userDao->contarTodos(), $page);

		$this->view->dataList = $userDao->getAllLimitOffset($paginator->getLimit(), $paginator->getOffset());
		$this->view->htmlPaginator = $paginator->showHtmlPaginator();
    }

    public function agregarAction()
    {
		//$id = Zend_Auth::getInstance()->getIdentity()->getId();
		$form = new App_Form_ContactoForm();
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$departamentoDao = new App_Dao_DepartamentoDao();
				$departamento = $departamentoDao->getDepartamentoPorId($formData['_departamento']);
					
				$telefonoCelular = new App_Model_Telefono($formData['_celular']);
				$telefonoCelular->setTipo(App_Model_Telefono::TELEFONO_CELULAR);
				
				$telefonoFijo = new App_Model_Telefono($formData['_fijo']);
				$telefonoFijo->setTipo(App_Model_Telefono::TELEFONO_CASA);
				
				$telefonoTrabajo = new App_Model_Telefono($formData['_trabajo']);
				$telefonoTrabajo->setTipo(App_Model_Telefono::TELEFONO_TRABAJO);
				
				$especialidadDao = new App_Dao_EspecialidadDao();
				$especialidad = $especialidadDao->getEspecialidadPorId($formData['_especialidad']);
				
				$contacto = new App_Model_Contacto();
				$contacto->agregarTelefono($telefonoCelular);
				$contacto->agregarTelefono($telefonoFijo);
				$contacto->agregarTelefono($telefonoTrabajo);
				$contacto->setDepartamento($departamento);
				$contacto->setNombres($formData['_nombres']);
				$contacto->setApellidos($formData['_apellidos']);
				$contacto->setEspecialidad($especialidad);
				$contacto->setEmail($formData['_email']);
				$contacto->setDireccion($formData['_direccion']);
				
				$contacto->setFoto($formData['MAX_FILE_SIZE']);
				
				$fijoDao = new App_Dao_TelefonoDao();
				$fijoDao->guardar($telefonoFijo);
				$celDao = new App_Dao_TelefonoDao();
				$celDao->guardar($telefonoCelular);
				$trabajoDao = new App_Dao_TelefonoDao();
				$trabajoDao->guardar($telefonoTrabajo);
				
				$contactoDao = new App_Dao_ContactoDao();
				$contactoDao->guardar($contacto);				
				
				$this->_helper->redirector('index');
				return;
			}
		}
		$this->view->form = $form;
    }

    public function verAction()
    {
        $id = $this->_getParam('id');
		
		$contactoDao = new App_Dao_ContactoDao();
		$contacto = $contactoDao->getContactoPorId($id);
		$this->view->contacto = $contacto;
		
    }

    public function editarAction()
    {
        // action body
    }


}







