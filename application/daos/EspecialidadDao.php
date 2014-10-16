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
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	public function editar(App_Model_Especialidad $especialidad) {
		$this->_entityManager->persist($especialidad);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	public function eliminar(App_Model_Especialidad $especialidad) {
		$this->_entityManager->remove($especialidad);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	
	public function getEspecialidadPorId($id) {
		return $this->_entityManager->find("App_Model_Especialidad", $id);
	}
	
	public function getTipo($tipo) {
		$consulta = $this->_entityManager->createQuery("SELECT e FROM App_Model_Especialidad e WHERE e._tipo = '" . $tipo . "'");
		return $consulta->getResult();
	}
	
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT e FROM App_Model_Especialidad e');
		return $consulta->getResult();
	}
}
