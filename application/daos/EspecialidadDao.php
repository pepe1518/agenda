<?php
class App_Dao_EspecialidadDao 
{
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Especialidad $especialidad) {
		$this->_entityManager->persist($especialidad);
		$this->_entityManager->flush();
	}
	public function editar(App_Model_Especialidad $especialidad) {
		$this->_entityManager->persist($especialidad);
		$this->_entityManager->flush();
	}
	public function eliminar(App_Model_Especialidad $especialidad) {
		$this->_entityManager->remove($especialidad);
		$this->_entityManager->flush();
	}
	
	public function getEspecialidadPorId($id) {
		return $this->_entityManager->find("App_Model_Especialidad", $id);
	}
	
	public function getNombre($nombre) {
		$consulta = $this->_entityManager->createQuery("SELECT e FROM App_Model_Especialidad e WHERE e._nombre = '" . $nombre . "'");
		return $consulta->getResult();
	}
	
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT e FROM App_Model_Especialidad e');
		return $consulta->getResult();
	}
}
