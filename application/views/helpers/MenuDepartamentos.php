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
			if (Zend_Auth::getInstance()->getIdentity()){
				$urlArea = $this->view->url(
					array(
						'controller'  => 'categoria',
						'action'      => 'index',
						'departamento'=> $departamento->getId()
					), 'default', true);
			}
			else{
				$urlArea = "#";
			}

			$urlContacto = $this->view->url(
					array(
						'controller' => 'contacto',
						'action'     => 'index',
						'id'		 => $departamento->getId()
					), 'default', true);
					
			$nombre = $departamento->getNombre();
			$html .= "<li>";
                        
                        
			$html .= "<h1><strong>". $nombre ."</strong></h1>";
                    
                        
			$html .= "</li>";
                        $urlContacto = $this->view->url(
					array(
						'controller' => 'contacto',
						'action'     => 'index',
						'departamento' => $departamento->getId()
					), 'default', true);
                        $html .= "<li><h1><a href=\"".$urlContacto."\">Contactos Medicos</a></h1></li>";
			$html .= "<li><h1><a href=\"".$urlArea."\">Areas</a></h1></li>";
			$categoriaDao = new App_Dao_CategoriaDao(); //aqui poner
			foreach($categoriaDao->getCAtegoriaPorDepartamento($departamento->getId()) as $categoria) {
					
				$urlCategoria = $this->view->url(
					array(
						'controller' => 'entidad',
						'action'     => 'index',
						'id'		 => $categoria->getId(),
                     'departamento'  => $departamento->getId()
					), 'default', true);
					$image = ($categoria->getFoto())?stream_get_contents($categoria->getFoto()):"#";
				$html .= "<li><img src=\"".$image ."\" width=\"30\"/> &nbsp; <a href=\"".$urlCategoria."\">".
						 $categoria->getNombre()."</a></li>";
			}
			
			//$html .= "</ul>";
		}	
		/*	
		$html .= "<a href=\"". $this->view->url(
					array(
						'controller' => 'user',
						'action'     => 'logout'
					), 'default', true) ."\" >Salir</a>";
                */
		$html .= "</li>";

		$html .= "</ul>";
		$html .= "</div>";
		return $html;
	}
}
