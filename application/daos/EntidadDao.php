<?php
class App_Dao_EntidadDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_Entidad $entidad) {
		$this->_entityManager->persist($entidad);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	
	public function eliminar(App_Model_Entidad $entidad) {
		$this->_entityManager->remove($entidad);
		$this->_entityManager->flush();
		$modificacionesDao = new App_Dao_ModificacionesDao();
		$modificaciones = new App_Model_Modificaciones();
		$modificacionesDao->guardar($modificaciones); 
	}
	
	public function getEntidadPorId($id) {
		return $this->_entityManager->find("App_Model_Entidad", $id);
	}
	
	public function getAllLimitOffset($limit, $offset, $idCategoria, $idDepartamento, $idEspecialidad = 0)
	{
		if($idEspecialidad == 0){
			$query = $this->_entityManager->createQuery("SELECT e FROM App_Model_Entidad e WHERE e._categoria = '". $idCategoria ."'")
								->setFirstResult($offset)
								->setMaxResults($limit);
		
			return $query->getResult();
		}
		else{	
			$query = $this->_entityManager->createQuery("SELECT e FROM App_Model_Entidad e WHERE e._categoria = '". $idCategoria ."' AND e._especialidad = '". $idEspecialidad ."'")
								->setFirstResult($offset)
								->setMaxResults($limit);
		
			return $query->getResult();
		}
	}
	public function contarTodos(){
		$consulta = $this->_entityManager->createQuery('SELECT COUNT(e) FROM App_Model_Entidad e');
		return $consulta->getSingleScalarResult();
	}
	
}
