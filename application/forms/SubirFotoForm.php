<?php
defined('APPLICATION_UPLOADS_DIR')
     || define('APPLICATION_UPLOADS_DIR', realpath(dirname(__FILE__) . '/../data/uploads'));
class App_Form_SubirFotoForm extends Zend_Form
{
public function __construct($options = null)
	{
		parent::__construct($options);
		
		$this->setName("Document");
		$this->setAction("");
		$this->setAttrib("enctype", "multipart/form-data");
                
                
		$docFile = new Zend_Form_Element_File("doc_path");
		$docFile->setLabel("Ruta del Archivo")->setRequired(TRUE);
                //prueba pra añadir imagen de aqui
                $docFile->addValidator('Size', false, 1024000);
                $docFile->addValidator('Extension', false, 'jpg,png,jpeg');
                $docFile->addValidator('MimeType', false, 'image/png, image/jpg, image/jpeg');
                $docFile->addValidator('Count', false, array('min' => 0, 'max' => 4));
                
		$docFile->setDestination(APPLICATION_PATH ."/../data/upload/galeria"); 
                //prueba fin 
		$submit = new Zend_Form_Element_Submit("Enviar");
		$submit->setLabel("Subir Archivo")->setAttrib("id", "submit_button");
		
		$this->addElements(array($docFile, $submit));
	}
}

