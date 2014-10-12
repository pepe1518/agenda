<?php

class App_Form_EspecialidadForm extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
		
		$nombre = new Zend_Form_Element_Text('_nombre');
		$nombre->setRequired(true);
		$nombre->setLabel('Nombre:');
		
		$tipo = new Zend_Form_Element_Select('_tipo');
		$tipo->setRequired(true);
		$tipo->addMultiOption(App_Model_Especialidad::ESPECIALIDAD, 
							  App_Model_Especialidad::ESPECIALIDAD);
		$tipo->addMultiOption(App_Model_Especialidad::SUBESPECIALIDAD,
							  App_Model_Especialidad::SUBESPECIALIDAD);
		$tipo->setLabel('Tipo:');
		
    	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Guardar'));
		
		$this->addElements(array($nombre, $tipo, $submit));
	}
}
