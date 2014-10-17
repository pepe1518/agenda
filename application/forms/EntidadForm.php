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
		
		$especialidadDao = new App_Dao_EspecialidadDao();
		$especialidades = $especialidadDao->getTodos();
		
		$especialidad = new Zend_Form_Element_Select('_especialidad');
		$especialidad->setLabel('Especialidad:');
		foreach($especialidades as $data){
			//if($data->getTipo == App_Model_Especialidad::ESPECIALIDAD)	
				$especialidad->addMultiOption($data->getId(), $data->getNombre());
		}
		
		$telefono = new Zend_Form_Element_Text('_telefono');
		$telefono->setLabel('Telefono:*');
		$telefono->addValidator(new Zend_Validate_Digits());
		$telefono->addErrorMessage("Por Favor Solo ingrese numeros");
                
                $email = new Zend_Form_Element_Text('_email');
		$email->setLabel('Correo Electronico:');
		$email->setRequired(FALSE);
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addErrorMessage('Ingrese una dirección de correo valido por ejemplo:'.PHP_EOL.' usuario@mail.com');
		
		$foto = new Zend_Form_Element_File("_foto");
		$foto->setLabel("Ruta de la Foto")->setRequired(false);
    	
    	$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Enviar'));
		
		$this->addElements(array($nombre, $especialidad, $telefono, $encargado, $email, $direccion,  $submit));
	}
}

