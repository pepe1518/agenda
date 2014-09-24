<?php
class Zend_View_Helper_MenuDepartamentos extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function menuDepartamentos() {
		$url1 = $this->view->url(array('controller'=> 'contacto', 
										  'action' 	  => 'index',
										  
									), 'default', true);
		$url2 = $this->view->url(array('controller'=> 'entidad', 
										  'action' 	  => 'index',
										  
									), 'default', true);												
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Menú</h1>";
		$html .= "<ul>";	
		$html .= "<li><a href=\"".$url1."\"><h1>Personas</h1></a></li>";
		$departamentoDao = new App_Dao_DepartamentoDao();
		foreach($departamentoDao->getTodos() as $departamento) {
			$url = $this->view->url(array('controller'=> 'contacto', 
										  'action' 	  => 'index',
										  'id'		  => $departamento->getId()
									), 'default', true);
			$nombre = $departamento->getNombre();
			$html .= "<li>";
			$html .= "<a href=\"". $url ."\">". $nombre ."</a>";
			$html .= "</li>";
		}	
		$html .= "<li><a href=\"".$url2."\"><h1>Instituciones</h1></a></li>";
		$departamentoDao = new App_Dao_DepartamentoDao();
		foreach($departamentoDao->getTodos() as $departamento) {
			$url = $this->view->url(array('controller'=> 'entidad', 
										  'action' 	  => 'index',
										  'id'		  => $departamento->getId()
									), 'default', true);
			$nombre = $departamento->getNombre();
			$html .= "<li>";
			$html .= "<a href=\"". $url ."\">". $nombre ."</a>";
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
