<?php
class App_Dao_DepartamentoDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Departamento $Departamento) {
		$this->_entityManager->persist($Departamento);
		$this->_entityManager->flush();
	}
	
	
	public function getDepartamentoPorId($id) {
		return $this->_entityManager->find("App_Model_Departamento", $id);
	}
	
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT c FROM App_Model_Departamento c');
		return $consulta->getResult();
	}
	
	public function contarTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT COUNT(d) FROM App_Model_Departamento d');
		return $consulta->getSingleScalarResult();
	}
	
	
	
}
