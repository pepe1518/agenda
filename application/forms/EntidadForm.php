<?php

class App_Form_EntidadForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
		
		$nombre = new Zend_Form_Element_Text('_nombre');
		$nombre->setLabel('Nombre:*');
		$nombre->setRequired(TRUE);
		//$nombre->addValidator(new Zend_V);
		//$nombre->addErrorMessage("Debes ingresar algo valido");
    
    	$encargado = new Zend_Form_Element_Text('_encargado');
		$encargado->setLabel('Encargado:*');
		$encargado->setRequired(TRUE);
		
		$direccion = new Zend_Form_Element_Text('_direccion');
		$direccion->setLabel('Direccion:');
		$direccion->setRequired(FALSE);
		
		$telefono = new Zend_Form_Element_Text('_telefono');
		$telefono->setLabel('Telefono:*');
		$telefono->addValidator(new Zend_Validate_Digits());
		$telefono->addErrorMessage("Por Favor Solo ingrese numeros");
    	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Enviar'));
		
		$this->addElements(array($nombre, $telefono, $encargado, $direccion, $submit));
	}
}

