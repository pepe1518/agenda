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
		$idDepartamento = $this->_getParam('departamento', '');
		$idEspecialidad = $this->_getParam('especialidad', '');
		$idSubEspecialidad = $this->_getParam('subEspecialidad', '');
		
		$departamentoDao = new App_Dao_DepartamentoDao();
		$this->view->departamento = $departamentoDao->getDepartamentoPorId($idDepartamento);

		$userDao = new App_Dao_ContactoDao();
		$paginator = new App_Util_Paginator($this->getRequest()->getBaseUrl() . '/contacto/index', $userDao->contarTodos(), $page);

		$this->view->dataList = $userDao->getAllLimitOffset($paginator->getLimit(), $paginator->getOffset(), $idEspecialidad, $idDepartamento, $idSubEspecialidad);
		$this->view->htmlPaginator = $paginator->showHtmlPaginator();
    }

    public function agregarAction()
    {
		//$id = Zend_Auth::getInstance()->getIdentity()->getId();
		$form = new App_Form_ContactoForm();
						
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			//Zend_Debug::dump($formData['MAX_FILE_SIZE']);
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
				
				$subEspecialidadDao = new App_Dao_EspecialidadDao();
				$subEspecialidad = $subEspecialidadDao->getEspecialidadPorId($formData['_subespecialidad']);
				
				$contacto = new App_Model_Contacto();
				$contacto->agregarTelefono($telefonoCelular);
				$contacto->agregarTelefono($telefonoFijo);
				$contacto->agregarTelefono($telefonoTrabajo);
				$contacto->setDepartamento($departamento);
				$contacto->setNombres($formData['_nombres']);
				$contacto->setApellidoPaterno($formData['_apellidoPaterno']);
                                $contacto->setApellidoMaterno($formData['_apellidoMaterno']);
				$contacto->setEspecialidad($especialidad);
				$contacto->setSubespecialidad($subEspecialidad);
				$contacto->setEmail($formData['_email']);
				$contacto->setDireccion($formData['_direccion']);
				//$contacto->setFoto(file_get_contents($formData['MAX_FILE_SIZE']));
				//$contacto->setFoto($formData['_foto']);
				
				$fijoDao = new App_Dao_TelefonoDao();
				$fijoDao->guardar($telefonoFijo);
				$celDao = new App_Dao_TelefonoDao();
				$celDao->guardar($telefonoCelular);
				$trabajoDao = new App_Dao_TelefonoDao();
				$trabajoDao->guardar($telefonoTrabajo);
				
				$contactoDao = new App_Dao_ContactoDao();
				$contactoDao->guardar($contacto);				
				
				$this->_redirect('/contacto/index/departamento/'.$formData['_departamento']);
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
        $id = $this->_getParam('id');
        if(empty($id))
            $this->_helper->redirector('index');
        
        $contactoDao = new App_Dao_ContactoDao();
        
        
        if($this->_request->getPost()){
            $formData = $this->_request->getPost();
            $form = new App_Form_ContactoForm();
            if($form->isValid($formData)){
                $contacto = $contactoDao->getContactoPorId($id);
                
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
		$subEspecialidadDao = new App_Dao_EspecialidadDao();
		$subEspecialidad = $subEspecialidadDao->getEspecialidadPorId($formData['_subespecialidad']);
				
		//$contacto = new App_Model_Contacto();
		//$contacto->agregarTelefono($telefonoCelular);
		//$contacto->agregarTelefono($telefonoFijo);
		//$contacto->agregarTelefono($telefonoTrabajo);

		$fonos = $contacto->getTelefonos();
		
		$idFonoUno = $fonos[0]->getId();
		$fonoDao1 = new App_Dao_TelefonoDao();
		$fono1 = $fonoDao1->getTelefonoPorId($idFonoUno);
		$fono1->setNumero($formData['_celular']);
		$fonoDao1->guardar($fono1);
		
		$idFonoDos = $fonos[1]->getId();
		$fonoDao2 = new App_Dao_TelefonoDao();
		$fono2 = $fonoDao2->getTelefonoPorId($idFonoDos);
		$fono2->setNumero($formData['_fijo']);
		$fonoDao2->guardar($fono2);
		
		$idFonoTres = $fonos[2]->getId();
		$fonoDao3 = new App_Dao_TelefonoDao();
		$fono3 = $fonoDao3->getTelefonoPorId($idFonoTres);
		$fono3->setNumero($formData['_trabajo']);
		$fonoDao3->guardar($fono3);
		//$contacto->agregarTelefonoPorIndex($telefonoCelular, 1);
		//$contacto->agregarTelefonoPorIndex($telefonoFijo, 2);
		//$contacto->agregarTelefonoPorIndex($telefonoTrabajo, 3);
		$contacto->setTelefonos($telefonos);

		$contacto->setDepartamento($departamento);
		$contacto->setNombres($formData['_nombres']);
		$contacto->setApellidoPaterno($formData['_apellidoPaterno']);
                $contacto->setApellidoMaterno($formData['_apellidoMaterno']);
		$contacto->setEspecialidad($especialidad);
		$contacto->setSubEspecialidad($subEspecialidad);
		$contacto->setEmail($formData['_email']);
		$contacto->setDireccion($formData['_direccion']);
				
		//$contacto->setFoto($formData['MAX_FILE_SIZE']);				
		$fijoDao = new App_Dao_TelefonoDao();
		$fijoDao->guardar($telefonoFijo);
		$celDao = new App_Dao_TelefonoDao();
		$celDao->guardar($telefonoCelular);
		$trabajoDao = new App_Dao_TelefonoDao();
		$trabajoDao->guardar($telefonoTrabajo);
                
                $contactoDao->guardar($contacto);
                //$contactoDao->editar($contacto,$id);
               $this->_redirect('/contacto/index/departamento/'.$formData['_departamento']);
                return;
            }
            else 
                $form->populate($formData);
            }else{
                $id = $this->_getParam('id');
                if (empty($id)) {
                    $this->_redirect('/contacto/index/departamento/'.$formData['_departamento']);
                    return;
                } else
                $form = new App_Form_ContactoForm(); 
            }
            $contacto = $contactoDao->getContactoPorId($id);
            
            if (!empty($contacto))
            $form->populate($contacto->toArray());
            $this->view->form = $form;
            
    }

    public function eliminarAction()
    {
        $id = $this->_getParam('id');
        
        if (empty($id))
            $this->_helper->redirector('index');
        
        $contactoDao = new App_Dao_ContactoDao();
        $contacto = $contactoDao->getContactoPorId($id);
		$depa = $contacto->getDepartamento();
        if(!empty($contacto))
        $contactoDao->eliminar($contacto);
        $this->_redirect('/contacto/index/departamento/'.$depa->getId());
        return;// action body
    }

    public function fotoAction()
    {
        $id = $this->_getParam('id', '');
		$this->view->id = $id;
		if ($this->getRequest()->isPost()) {
			//Zend_Debug::dump($_POST);
			if (empty($_POST['imageUrl'])) {
				$this->view->message = 'Debe de seleccionar una imagen.';
				return;
			}

			$contactoDao = new App_Dao_ContactoDao();
			$contacto = $contactoDao->getContactoPorId($id);
			
			$depa = $contacto->getDepartamento();
			
			$contacto->setFoto($_POST['imageUrl']);
			
			//$book->setCover($_POST['imageUrl']);
			//$book->setLastModified(date_create(date('Y-m-d H:m:s')));
			
			$contactoDao->guardar($contacto);
			//$entityManager->persist($book);
			//$entityManager->flush();

			//$this->_flashMessenger->addMessage('Imagen de portada de libro guardada.');
			$this->_redirect('/contacto/index/departamento/'.$depa->getId());
			return;
		}
    }


}
