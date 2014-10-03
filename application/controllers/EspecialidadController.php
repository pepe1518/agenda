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

    public function editarAction()
    {
        $id = $this->_getParam('id');
        if(empty($id))
            $this->_helper->redirector('index');
        $especialidadDao = new App_Dao_EspecialidadDao();
        
        if ($this->_request->getPost()) {
		$formData = $this->_request->getPost();

		if ($form->isValid($formData)) {
		//$especialidad = new App_Model_Especialidad();
		$especialidad = $especialidadDao->getEspecialidadPorId($id);		
		$especialidad->setNombre($formData['_nombre']);
				/*if($formData['_descripcion']){
					$especialidad->setDescription($formData['_descripcion']);
				}*/
				
		$especialidadDao = new App_Dao_EspecialidadDao();
		$especialidadDao->guardar($especialidad);
		$this->_helper->redirector('index');
		return;
			
            }
            else 
                $form->populate($formData);
	}else{
                $id = $this->_getParam('id');
                if (empty($id)) {
                    $this->_helper->redirector('index');
                    return;
                } else
                $form = new App_Form_EspecialidadForm(); 
            }
            $especialidad = $especialidadDao->getEspecialidadPorId($id);
            
            if (!empty($especialidad))
            $form->populate($especialidad->toArray());
            $this->view->form = $form;
            $this->view->especialidades = $especialidadDao->getTodos();
    }

    public function eliminarAction()
    {
        $id = $this->_getParam('id');
        
        if (empty($id))
            $this->_helper->redirector('index');
        
        $EspecialidadDao = new App_Dao_EspecialidadDao();
        $especialidad = $EspecialidadDao->getContactoPorId($id);
        if(!empty($especialidad))
        $EspecialidadDao->eliminar($especialidad);
        $this->_helper->redirector('index');
        return;// action body
    }


}





