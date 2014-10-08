<?php

class App_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        $username = $this->createElement('text','_usuario');
        $username->setLabel('Nombre Usuario: *')
                ->setRequired(true);
                
        $password = $this->createElement('password','_contrasenia');
        $password->setLabel('Contrasena: *')
                ->setRequired(true);
                
        $signin = $this->createElement('submit','signin');
        $signin->setLabel('Ingresar')
                ->setIgnore(true);
		
		/*$baseUrlHelper = new Zend_View_Helper_BaseUrl();
        $link = $baseUrlHelper->baseUrl('user/agregar');
  		$signin->setDescription('<a href="'.$link .'" >Nuevo</a>')
			   ->setDecorators(array(
        			'ViewHelper',
        			array('Description', array('escape' => false, 'tag' => false)),
        			array('HtmlTag', array('tag' => 'dd')),
        			'Errors',
     			 ));*/
        
                
        $this->addElements(array(
                        $username,
                        $password,
                
                        $signin,
        ));
    }
}

