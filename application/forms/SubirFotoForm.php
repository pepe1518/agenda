<?php

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
		
		$submit = new Zend_Form_Element_Submit("Enviar");
		$submit->setLabel("Subir Archivo")->setAttrib("id", "submit_button");
		
		$this->addElements(array($docFile, $submit));
	}
}

