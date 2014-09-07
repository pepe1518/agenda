<?php
class App_Dao_EndidadDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Entidad $entidad) {
		$this->_entityManager->persist($entidad);
		$this->_entityManager->flush();
	}
	
	public function eliminar(App_Model_Entidad $entidad) {
		$this->_entityManager->remove($entidad);
		$this->_entityManager->flush();
	}
	
	public function getEntidadPorId($id) {
		return $this->_entityManager->find("App_Model_Entidad", $id);
	}
}
