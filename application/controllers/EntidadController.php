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
        $departamento = $this->_getParam('departamento', ' ');
        //manda a la vista la variable  departamento
        //mapeo de la var  departamento
        //var_dump($departamento);
        $this->view->idDepartamento = $departamento;
		if($idCategoria) {
			$categoriaDao = new App_Dao_CategoriaDao();
            $departamentoDao = new App_Dao_DepartamentoDao();
			$this->view->categoria = $categoriaDao->getCategoriaPorId($idCategoria);
            $this->view->departamento = $departamentoDao->getDepartamentoPorId($departamento);
			
			$page = $this->_getParam('page', 1);
			$entidadDao = new App_Dao_EntidadDao();
			$paginador = new App_Util_Paginator($this->getRequest()->getBaseUrl(). '/entidad/index', $entidadDao->contarTodos(), $page);
			$this->view->entidades = $entidadDao->getAllLimitOffset($paginador->getLimit(), $paginador->getOffset(), $idCategoria);
			$this->view->htmlPaginator = $paginador->showHtmlPaginator();
		}
 	
    }

    public function agregarAction()
    {
       $delma = $this->_getParam('delma');
       $ceci = $this->_getParam('ceci');
       echo "hola delma soy tuyo atte:". $delma;
       echo "</br>";
       echo "hola ceci soy tuyo atte:". $ceci;
        $form = new App_Form_EntidadForm();
	   if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$idCategoria = $this->_getParam('id');
				$categoriaDao = new App_Dao_CategoriaDao();
				$categoria = $categoriaDao->getCategoriaPorId($idCategoria);
				
				$telefono = new App_Model_Telefono($formData['_telefono']);
				
				$entidad = new App_Model_Entidad();
				$entidad->setNombre($formData['_nombre']);
				$entidad->setCategoria($categoria);
				$entidad->setDireccion($formData['_direccion']);
				$entidad->setTelefono($telefono);
				$entidad->setEncargado($formData['_encargado']);
				
				$telefonoDao = new App_Dao_TelefonoDao();
				$telefonoDao->guardar($telefono);
				
				$entidadDao = new App_Dao_EntidadDao();
				$entidadDao->guardar($entidad);
				
				$this->_helper->redirector('lista');
				return;
			}
	   }
	   $this->view->form = $form;
    }

    public function editarAction()
    {
        // action body
    }
    public function eliminarAction()
    {
        $id = $this->_getParam('id');
        
        if (empty($id))
            $this->_helper->redirector('index');
        
        $entidadDao = new App_Dao_EntidadDao();
        $entidad = $entidadDao->getEntidadPorId($id);
        if(!empty($entidad))
        $entidadDao->eliminar($entidad);
        $this->_helper->redirector('index');
        return;// action body
    }
    public function listaAction()
    {
        // action body
    }


}


