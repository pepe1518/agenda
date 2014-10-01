<?php

class EspecialidadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new App_Form_EspecialidadForm();
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();

			if ($form->isValid($formData)) {
				$especialidad = new App_Model_Especialidad();
				
				$especialidad->setNombre($formData['_nombre']);
				/*if($formData['_descripcion']){
					$especialidad->setDescription($formData['_descripcion']);
				}*/
				
				$especialidadDao = new App_Dao_EspecialidadDao();
				$especialidadDao->guardar($especialidad);
				$this->_helper->redirector('index');
				return;
			
			}
		}		
		$this->view->form = $form;
		
        $especialidadDao = new App_Dao_EspecialidadDao();
		$this->view->especialidades = $especialidadDao->getTodos();
    }


}

