<?php
class App_Dao_TelefonoDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Telefono $telefono) {
		$this->_entityManager->persist($telefono);
		$this->_entityManager->flush();
	}
	
	public function eliminar(App_Model_Telefono $telefono) {
		$this->_entityManager->remove($telefono);
		$this->_entityManager->flush();
	}
	
	public function getTelefonoPorId($id) {
		return $this->_entityManager->find("App_Model_Telefono", $id);
	}
	
	public function getNumeroTelefono($numero) {
		$consulta = $this->_entityManager->createQuery("SELECT t FROM App_Model_Telefono t WHERE t._numero = '" . $numero . "'");
	}
}
