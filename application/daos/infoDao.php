<?php
class App_Dao_InfoDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Info $info) {
		$this->_entityManager->persist($info);
		$this->_entityManager->flush();
	}
	
	public function getInfoPorId($id) {
		return $this->_entityManager->find("App_Mode_Info", $id);
	}
	
	public function getPorNombre($nombre) {
		$consulta = $this->_entityManager->createQuery("SELECT i FROM App_Model_Info i WHERE i._nombre = '".$nombre."'");
		return $consulta->getResult();
	
	}
}
