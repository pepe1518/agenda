<?php
class App_Dao_CategoriaDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Categoria $categoria) {
		$this->_entityManager->persist($categoria);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	
	public function eliminar(App_Model_Categoria $categoria) {
		$this->_entityManager->remove($categoria);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	
	public function getCategoriaPorId($id) {
		return $this->_entityManager->find("App_Model_Categoria", $id);
	}
	
	public function getNombre($nombre) {
		$consulta = $this->_entityManager->createQuery("SELECT c FROM App_Model_Especialidad c WHERE c._nombre = '" . $nombre . "'");
		return $consulta->getResult();
	}
	
	public function getCAtegoriaPorDepartamento($idDepartamento) {
		$consulta = $this->_entityManager->createQuery("SELECT c FROM App_Model_Categoria c WHERE c._departamento = '" . $idDepartamento . "'");
		return $consulta->getResult();
	}
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT c FROM App_Model_Categoria c');
		return $consulta->getResult();
	}
}
