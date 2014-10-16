<?php

class App_Form_ModificarForm extends Zend_Form
{
	public function init()
    {
        $this->setMethod('post');
		
		$nombre = new Zend_Form_Element_Textarea('_descripcion');
		$nombre->setRequired(true);
		$nombre->setLabel('Descripción:');
		   	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Guardar'));
		
		$this->addElements(array($nombre, $submit));
	}
}

