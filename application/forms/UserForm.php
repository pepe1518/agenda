<?php

class Application_Form_UserForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        
        $usuario = new Zend_Form_Element_Text('_usuario');
	/*$usuario = $this->createElement('text', '_usuario');*/
	$usuario->setLabel('Usuario:*');
	$usuario->setRequired(true);
        
        $contrasenia = new Zend_Form_Element_Password('_contrasenia');
	/*$contrasenia = $this->createElement('text', '_contrasenia');*/
	$contrasenia->setLabel('Contraseña:*');
	$contrasenia->setRequired(true);
        
        $nombres = new Zend_Form_Element_Text('_nombre');
	/*$nombres = $this->createElement('text', '_nombre');*/
	$nombres->setLabel('Nombres:*');
	$nombres->setRequired(true);
        
        $apellidos = new Zend_Form_Element_Text('_apellido');
	$apellidos->setLabel('Apellidos:*');
	$apellidos->setRequired(true);
                
        	
        $this->addElements(array( $usuario, $contrasenia, $nombres, $apellidos));
        
        
        
        
    }


}


