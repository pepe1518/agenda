<?php
class Zend_View_Helper_MenuDepartamentos extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function menuDepartamentos() {
		$menu = "";
		$departamentoDao = new App_Dao_DepartamentoDao();
		foreach($departamentoDao->getTodos() as $departamento) {
			$url = $this->view->url(array('controller'=> 'entidad', 
										  'action' 	  => 'index',
										  'id'		  => $departamento->getId()
									), 'default', true);
			$nombre = $departamento->getNombre();
			$menu .= "<li>";
			$menu .= "<a href=\"". $url ."\">". $nombre ."</a>";
			$menu .= "</li>";
		}	
			
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Menú</h1>";
		$html .= "<ul>";	
		$html .= "<li><h1>Personas</h1></li>";
		$html .= $menu;
		$html .= "<li><h1>Instituciones</h1></li>";
		$html .= $menu;		
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
