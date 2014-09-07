<?php
class Zend_View_Helper_MenuForm extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function menuForm() {
		
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Menú</h1>";
		$html .= "<ul>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl(). "/contacto\">Mis Contactos.</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/institucion\">Mis Instituciones</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"".$this->view->baseUrl()."/backup\">Respaldo de la Base de Datos</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/user\">Administración de mi Cuenta</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/especialidad\">Administración de Especialidades</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->url(
					array(
						'controller' => 'user',
						'action'     => 'logout'
					), 'default', true) ."\" >Salir</a>";
		$html .= "</li>";
		$html .= "</ul>";
		$html .= "</div>";
		return $html;
	}
}