<?php

class EntidadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $idCategoria = $this->_getParam('id', ' ');
       $idDepartamento = $this->_getParam('departamento');
	   $idEspecialidad = $this->_getParam('especialidad', '');
	   
	   
        //manda a la vista la variable  departamento
        //mapeo de la var  departamento
		$departamentoDao = new App_Dao_DepartamentoDao();
		//Zend_Debug::dump($departamentoDao->getDepartamentoPorId($idDepartamento)); die;
		$this->view->departamento = $departamentoDao->getDepartamentoPorId($idDepartamento);
		if($idCategoria) {
			$categoriaDao = new App_Dao_CategoriaDao();
            $departamentoDao = new App_Dao_DepartamentoDao();
			$this->view->categoria = $categoriaDao->getCategoriaPorId($idCategoria);
            //$this->view->departamento = $departamentoDao->getDepartamentoPorId($departamento);
			
			$page = $this->_getParam('page', 1);
			$entidadDao = new App_Dao_EntidadDao();
			$paginador = new App_Util_Paginator($this->getRequest()->getBaseUrl(). '/entidad/index/id/'.$idCategoria.'/departamento/'.$idDepartamento, $entidadDao->contarTodos(), $page);
			$this->view->entidades = $entidadDao->getAllLimitOffset($paginador->getLimit(), $paginador->getOffset(), $idCategoria, $idDepartamento, $idEspecialidad);
			$this->view->htmlPaginator = $paginador->showHtmlPaginator();
		}
 	
    }
    

    public function agregarAction()
    {
       //$delma = $this->_getParam('delma');
       //$ceci = $this->_getParam('ceci');
	   $idDepartamento = $this->_getParam('departamento');
	   $idCategoria = $this->_getParam('id');

        $form = new App_Form_EntidadForm();
	   if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				
				$categoriaDao = new App_Dao_CategoriaDao();
				$this->view->idDepartamento = $idDepartamento;
				$categoria = $categoriaDao->getCategoriaPorId($idCategoria);
				
				$departamentoDao = new App_Dao_DepartamentoDao();
				
				$depa = $departamentoDao->getDepartamentoPorId($idDepartamento);
				
				$especialidadDao = new App_Dao_EspecialidadDao();
				$especialidad = $especialidadDao->getEspecialidadPorId($formData['_especialidad']);
				
				$telefono = new App_Model_Telefono($formData['_telefono']);
				
				$entidad = new App_Model_Entidad();
				$entidad->setNombre($formData['_nombre']);
				$entidad->setEspecialidad($especialidad);
				$entidad->setCategoria($categoria);
                                $entidad->setDireccion($formData['_direccion']);
				$entidad->setEmail($formData['_email']);
				$entidad->setTelefono($telefono);
				$entidad->setEncargado($formData['_encargado']);
								
				//como aqui se guardan telefonos y entidades se hace 2 registros en la
				//tabla modificaciones 1 por e telefono y otro por almacenar la entidad+
				$telefonoDao = new App_Dao_TelefonoDao();
				$telefonoDao->guardar($telefono);
				
				$entidadDao = new App_Dao_EntidadDao();
				$entidadDao->guardar($entidad);
				
				$this->_redirect('/entidad/index/id/'.$idCategoria."/departamento/".$idDepartamento);
				return;
			}
	   }
	   $this->view->form = $form;
    }

    public function editarAction()
    {
      $id = $this->_getParam('id');	
      $idDepartamento = $this->_getParam('departamento');
      if(empty($idDepartamento))
          $this->_helper->redirector('index');
	
        $form = new App_Form_EntidadForm();
	   if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$idCategoria = $this->_getParam('id');
				$categoriaDao = new App_Dao_CategoriaDao();
				$this->view->idDepartamento = $idDepartamento;
				$categoria = $categoriaDao->getCategoriaPorId($idCategoria);
				
				$departamentoDao = new App_Dao_DepartamentoDao();
				
				$depa = $departamentoDao->getDepartamentoPorId($idDepartamento);
				
				$especialidadDao = new App_Dao_EspecialidadDao();
				$especialidad = $especialidadDao->getEspecialidadPorId($formData['_especialidad']);
				
				$telefono = new App_Model_Telefono($formData['_telefono']);
				
				$entidad = new App_Model_Entidad();
				$entidad->setNombre($formData['_nombre']);
				$entidad->setEspecialidad($especialidad);
				$entidad->setCategoria($categoria);
				$entidad->setDireccion($formData['_direccion']);
				$entidad->setTelefono($telefono);
				$entidad->setEncargado($formData['_encargado']);
				//$entidad->setDepartamento($depa);
				
				$telefonoDao = new App_Dao_TelefonoDao();
				$telefonoDao->guardar($telefono);
				
				$entidadDao = new App_Dao_EntidadDao();
				$entidadDao->guardar($entidad);
				
				$this->_redirect('/entidad/index/id/'.$idCategoria."/departamento/".$idDepartamento);
				return;
			}else 
                $form->populate($formData);
                        
	   }else{
               
                //$id = $this->_getParam('id');
                //$this->_redirect('/entidad/index/id/'.$id."/departamento/".$idDepartamento);
                $form = new App_Form_EntidadForm(); 
            }
	     
           
           $entidadDao = new App_Dao_EntidadDao();
		   $entidad = $entidadDao->getEntidadPorId($id);
            $form->populate($entidad->toArray());
            $this->view->form = $form;
            
    }
    

    public function eliminarAction()
    {
        $id = $this->_getParam('id');
        
        if (empty($id))
            $this->_helper->redirector('index');
        
        $entidadDao = new App_Dao_EntidadDao();
        $entidad = $entidadDao->getEntidadPorId($id);
		$idCategoria = $entidad->getCategoria()->getId();
		$idDepartamento = $entidad->getCategoria()->getDepartamento()->getId();
		
        if(!empty($entidad))
        	$entidadDao->eliminar($entidad);
        
        $this->_redirect('/entidad/index/id/'.$idCategoria."/departamento/".$idDepartamento);
		return;
    }

    public function listaAction()
    {
        // action body
    }

    public function verAction()
    {
         $id = $this->_getParam('id');
		
		$entidadDao = new App_Dao_EntidadDao();
		$entidad = $entidadDao->getEntidadPorId($id);
		$this->view->entidad = $entidad;
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

			$contactoDao = new App_Dao_EntidadDao();
			$contacto = $contactoDao->getEntidadPorId($id);
			
			//Zend_Debug::dump($contacto); die;
			
			$contacto->setFoto($_POST['imageUrl']);
			
			//$book->setCover($_POST['imageUrl']);
			//$book->setLastModified(date_create(date('Y-m-d H:m:s')));
			
			$contactoDao->guardar($contacto);
			//$entityManager->persist($book);
			//$entityManager->flush();
			$idCAtegoria = $contacto->getCategoria()->getId();
			$idDepartamento = $contacto->getCategoria()->getDepartamento()->getId();
			//$this->_flashMessenger->addMessage('Imagen de portada de libro guardada.');
			$this->_redirect('/entidad/index/id/'.$idCAtegoria."/departamento/".$idDepartamento);
			return;
		}
    }


}






