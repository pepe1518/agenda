<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Zend_View_Helper_MenuAdmin extends Zend_View_Helper_Abstract
{
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function menuForm() {
		
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Menú</h>";
		$html .= "<ul>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl(). "/contacto\">Contactos</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<h1>Instituciones</h1>";
		$html .= "</li>";
		
		$categoriaDao = new App_Dao_CategoriaDao();
		foreach($categoriaDao->getTodos() as $categoria) {
			$url = $this->view->url(array('controller'=> 'entidad', 
										  'action' 	  => 'index',
										  'id'		  => $categoria->getId()
									), 'default', true);
			$nombre = $categoria->getNombre();
			$html .= "<li>";
			$html .= "<a href=\"". $url ."\">". $nombre ."</a>";
			$html .= "</li>";			
		}
		
		//$html .= "<li>";
		//$html .= "<a href=\"".$this->view->baseUrl()."/backup\">Respaldo de la Base de Datos</a>";
		//$html .= "</li>";
		$html .= "<li>";
		$html .= "<h1>Administración</h1>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/especialidad\">Administración de Especialidades</a>";
		$html .= "</li>";
		//$html .= "<li>";
		//$html .= "<li>";
		//$html .= "<a href=\"". $this->view->baseUrl()."/categoria\">Categorias de mis Instituciones</a>";
		//$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->url(
					array(
						'controller' => 'user',
						'action'     => 'agregar',
					), 'default', true) ."\" >Agregar Usuario</a>";
		$html .= "</li>";
		$html .= "<li>";
		$html .= "<a href=\"". $this->view->baseUrl()."/user\">Joise</a>";
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