<?php

class CategoriaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new App_Form_CategoriaForm();
		$idDepartamento = $this->_getParam('departamento');
		$departamentoDao = new App_Dao_DepartamentoDao();
		$departamento = $departamentoDao->getDepartamentoPorId($idDepartamento);
		$this->view->departamento = $departamento;
		if ($this->_request->getPost()) {
			//$formData = $this->_request->getPost();
				//Zend_Debug::dump($_POST); die;
			//if ($form->isValid($formData)) {
				if (empty($_POST['imageUrl'])) {
				$this->view->message = 'Debe de seleccionar una imagen.';
				return;
				}
					
				$especialidad = new App_Model_Categoria();
				
				$especialidad->setNombre($_POST['_nombre']);
				$especialidad->setFoto($_POST['imageUrl']);
				$especialidad->setDepartamento($departamento);
								
				$especialidadDao = new App_Dao_CategoriaDao();
				$especialidadDao->guardar($especialidad);
				$this->_redirect('/categoria/index/departamento/'.$idDepartamento);
				return;
			
			//}
		}		
		$this->view->form = $form;
		
        $especialidadDao = new App_Dao_CategoriaDao();
		$this->view->especialidades = $especialidadDao->getCAtegoriaPorDepartamento($idDepartamento);
    }


}

