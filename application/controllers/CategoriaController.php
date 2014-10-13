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
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			$idDepartamento = $this->_getParam('departamento');
			if ($form->isValid($formData)) {
				$departamentoDao = new App_Dao_DepartamentoDao();
				$departamento = $departamentoDao->getDepartamentoPorId($idDepartamento);
				
				$this->view->departamento = $departamento;
					
				$especialidad = new App_Model_Categoria();
				
				$especialidad->setNombre($formData['_nombre']);
				$especialidad->setDepartamento($departamento);
								
				$especialidadDao = new App_Dao_CategoriaDao();
				$especialidadDao->guardar($especialidad);
				$this->_helper->redirector('index');
				return;
			
			}
		}		
		$this->view->form = $form;
		
        $especialidadDao = new App_Dao_CategoriaDao();
		$this->view->especialidades = $especialidadDao->getTodos();
    }


}

