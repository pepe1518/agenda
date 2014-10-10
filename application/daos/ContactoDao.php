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
        
        public function editar(App_Model_Contacto $contacto, $id) {
              
                $this->_entityManager->update($contacto);
                
		$this->_entityManager->persist($contacto);
		$this->_entityManager->flush();
              
        }
          
	public function eliminar(App_Model_Contacto $contacto) {
		$this->_entityManager->remove($contacto);
		$this->_entityManager->flush();
	}
	
	public function getContactoPorId($id) {
		return $this->_entityManager->find("App_Model_Contacto", $id);                
	}
	public function getContactoPorEspecialidad($especialidad) {
                return $this->_entityManager->find("App_Model_Contacto", $especialidad);
        }
	public function getTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT c FROM App_Model_Contacto c');
		return $consulta->getResult();
	}
	
	public function contarTodos() {
		$consulta = $this->_entityManager->createQuery('SELECT COUNT(c) FROM App_Model_Contacto c');
		return $consulta->getSingleScalarResult();
	}
	
	public function getAllLimitOffset($limit, $offset, $id = 0, $idDepartamento)
	{
		if($id == 0) {
			$query = $this->_entityManager->createQuery("SELECT c FROM App_Model_Contacto c WHERE c._departamento = '".$idDepartamento."'")
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
		}
		else {	
		$query = $this->_entityManager->createQuery("SELECT c FROM App_Model_Contacto c WHERE c._especialidad ='".$id."' AND c._departamento = '".$idDepartamento."'")
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
		}
	}
	
}
