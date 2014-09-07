<?php

class App_Form_EspecialidadForm extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
		
		$nombre = new Zend_Form_Element_Text('_nombre');
		$nombre->setRequired(true);
		$nombre->setLabel('Nombre:');
		
		$descripcion = new Zend_Form_Element_Textarea('_descripcion');
		$descripcion->setLabel('Descripción:');
		$descripcion->setAttrib("cols", "40");
		$descripcion->setAttrib("rows", "2");
    	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Guardar'));
		
		$this->addElements(array($nombre, $descripcion, $submit));
	}
}
