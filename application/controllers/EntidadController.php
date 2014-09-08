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
		if($idCategoria) {
			$categoriaDao = new App_Dao_CategoriaDao();
			$this->view->categoria = $categoriaDao->getCategoriaPorId($idCategoria);
			
			$page = $this->_getParam('page', 1);
			$entidadDao = new App_Dao_EntidadDao();
			$paginador = new App_Util_Paginator($this->getRequest()->getBaseUrl(). '/entidad/index', $entidadDao->contarTodos(), $page);
			$this->view->entidades = $entidadDao->getAllLimitOffset($paginador->getLimit(), $paginador->getOffset(), $idCategoria);
			$this->view->htmlPaginator = $paginador->showHtmlPaginator();
		}
    }

    public function agregarAction()
    {
       $idCategoria = $this->_getParam('id');
	   
	   $form = new App_Form_EntidadForm();
	   $this->view->form = $form;
	   
    }


}



