<?php
class Zend_View_Helper_MenuDepartamentos extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function menuDepartamentos() {
														
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Departamentos</h1>";
		$html .= "<ul>";	
		//$html .= "<li><a href=\""."#"."\"><h1>Personas</h1></a></li>";
		$departamentoDao = new App_Dao_DepartamentoDao();
		foreach($departamentoDao->getTodos() as $departamento) {
			
			$nombre = $departamento->getNombre();
			$html .= "<li>";
			$html .= "<h1>". $nombre ."</h1>";
			$html .= "</li>";
		}	
			
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
