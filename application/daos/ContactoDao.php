<?php
class App_Dao_ContactoDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Contacto $contacto) {
		$this->_entityManager->persist($contacto);
		$this->_entityManager->flush();
	}
	
	public function elminiar(App_Model_Contacto $contacto) {
		$this->_entityManager->remove($contacto);
		$this->_entityManager->flush();
	}
	
	public function getContactoPorId($id) {
		return $this->_entityManager->find("App_Model_Contacto", $id);
	}
	
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT c FROM App_Model_Contacto c');
		return $consulta->getResult();
	}
	
	public function contarTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT COUNT(c) FROM App_Model_Contacto c');
		return $consulta->getSingleScalarResult();
	}
	
	public function getAllLimitOffset($limit, $offset)
	{
		$query = $this->_entityManager->createQuery('SELECT c FROM App_Model_Contacto c')
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
	}
	
}
