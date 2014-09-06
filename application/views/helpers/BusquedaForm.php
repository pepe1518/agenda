<?php
class Zend_View_Helper_BusquedaForm extends Zend_View_Helper_Abstract {
	public $view;

	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function busquedaForm() {
		$html = "<div class=\"content_left_section\">";
		$html .= "<h1>Buscar por:</h1>";
		$html .= "<form id=\"search-form\" action=\"" . $this->view->baseUrl() . "/index/busqueda\" method=\"GET\">";
		$html .= "<input type=\"checkbox\" name=\"title\" value=\"title\" ";
		if ($this->view->title != null) {
			$html .= "checked=\"checked\"";
		}
		$html .= "/>";
		$html .= "Contacto";
		
		$html .= "<br />";
		$html .= "<input type=\"checkbox\" name=\"authors\" value=\"authors\" ";
		if ($this->view->authors != null) {
			$html .= "checked=\"checked\"";
		}
		$html .= "/>";
		$html .= "Institución";
		
		$html .= "<br />";
		$html .= "<input type=\"checkbox\" name=\"isbn\" value=\"isbn\" ";
		if ($this->view->isbn != null) {
			$html .= "checked=\"checked\"";
		}
		$html .= "/>";
		$html .= "Número de Telefono";
		
		$html .= "<br />";
		$html .= "<input type=\"checkbox\" name=\"year\" value=\"year\" ";
		if ($this->view->year != null) {
			$html .= "checked=\"checked\"";
		}
		$html .= "/>";
		
		$html .= "Todo";
		
		$html .= "<input id=\"search-topic\" type=\"hidden\" name=\"topic\"/>";
		
		$html .= "<br />";
		$html .= "<input type=\"text\" id=\"search-txtSearch\" name=\"txtSearch\" ";
		if ($this->view->txtSearch != null) {
			$html .= "value=\"".$this->view->txtSearch."\" ";
		}
		$html .= "/>";
		
		$html .= "<input type=\"submit\" value=\"Buscar\"/>";
		$html .= "</form>";
		$html .= "</div>";
		return $html;

	}

}
