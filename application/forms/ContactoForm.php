<?php
class App_Form_ContactoForm extends Zend_Form
{
    public function init()
	{
		//parent::__construct();
		
		$this->setMethod('POST');
		$this->setEnctype('multipart/form-data');
		
		$nombres = new Zend_Form_Element_Text('_nombres');
		$nombres = $this->createElement('text', '_nombres');
		$nombres->setLabel('Nombres:*');
		$nombres->setRequired(true);
		
		$apellidos = new Zend_Form_Element_Text('_apellidos');
		$apellidos->setLabel('Apellidos:*');
		$apellidos->setRequired(true);
		
		$celular = new Zend_Form_Element_Text('_celular');
		$celular->setLabel('Telefono Celular:*');
		$celular->setRequired(TRUE);
		$celular->addValidator(new Zend_Validate_Digits());
		$celular->addErrorMessage('Por favor ingrese números de telefono válido');
		
		$fijo = new Zend_Form_Element_Text('_fijo');
		$fijo->setLabel('Telefono Fijo:');
		$fijo->setRequired(FALSE);
		$fijo->addValidator(new Zend_Validate_Digits());
		$fijo->addErrorMessage('Por favor ingrese números de telefono válido');
		
		$trabajo = new Zend_Form_Element_Text('_trabajo');
		$trabajo->setLabel('Telefono Trabajo:');
		$trabajo->setRequired(FALSE);
		$trabajo->addValidator(new Zend_Validate_Digits);
		$trabajo->addErrorMessage('Por favor ingrese números de telefono válido');
		
		$especialidadDao = new App_Dao_EspecialidadDao();
		$especialidades = $especialidadDao->getTipo(App_Model_Especialidad::ESPECIALIDAD);
		$subEspecialidades = $especialidadDao->getTipo(App_Model_Especialidad::SUBESPECIALIDAD);
		
		$especialidad = new Zend_Form_Element_Select('_especialidad');
		$especialidad->setLabel('Especialidad:');
		foreach($especialidades as $data){
				$especialidad->addMultiOption($data->getId(), $data->getNombre());
		}
		
		$subespecialidad = new Zend_Form_Element_Select('_subespecialidad');
		$subespecialidad->setLabel('Sub-Especialidad:');
		foreach($subEspecialidades as $data){
				$subespecialidad->addMultiOption($data->getId(), $data->getNombre());
		}
		
		$departamentoDao = new App_Dao_DepartamentoDao();
		$departamentos = $departamentoDao->getTodos();
		
		$departamento = new Zend_Form_Element_Select('_departamento');
		$departamento->setLabel('Departamento:');
		foreach($departamentos as $data){
			$departamento->addMultiOption($data->getId(), $data->getNombre());
		}
		
		$email = new Zend_Form_Element_Text('_email');
		$email->setLabel('Correo Electronico:');
		$email->setRequired(FALSE);
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addErrorMessage('Ingrese una dirección de correo valido por ejemplo:'.PHP_EOL.' usuario@mail.com');
		
		$direccion = new Zend_Form_Element_Text('_direccion');
		$direccion->setLabel('Direccion:');
		$direccion->setRequired(FALSE);
		
		$foto = new Zend_Form_Element_File("_foto");
                $foto->setLabel("Ruta de la Foto")->setRequired(false);
                $foto->addValidator('Extension', false, 'jpg,png,jpeg');
                $foto->addValidator('MimeType', false, 'image/png, image/jpg, image/jpeg');
                //$foto->addValidator('Count', false, array('min' => 0, 'max' => 4));
                
		//$foto->setDestination(APPLICATION_PATH ."C:\xampp\htdocs\agenda\upload"); 
                
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Guardar'));
		
		$this->addElements(array($departamento, $nombres, $apellidos, $celular, 
								$fijo, $trabajo, $especialidad, $subespecialidad, 
								$email, $direccion, $submit));
	}
}

