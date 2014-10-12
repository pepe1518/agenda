<?php

class App_Form_CategoriaForm extends Zend_Form
{
	public function init()
    {
        $this->setMethod('post');
		
		$nombre = new Zend_Form_Element_Text('_nombre');
		$nombre->setRequired(true);
		$nombre->setLabel('Nombre:');
		   	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Guardar'));
		
		$this->addElements(array($nombre, $submit));
	}
}
