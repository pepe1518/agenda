<?php
class App_Dao_UserDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function guardar(App_Model_User $usuario) {
		$this->_entityManager->persist($usuario);
		$this->_entityManager->flush();	
	}	
	
	public function eliminar(App_Model_User $usuario) {
		$this->_entityManager->remove($usuario);
		$this->_entityManager->flush();
	}
	
	public function getUsuarioPorId($id) {
		return $this->_entityManager->find("App_Model_User", $id);
	}
	
	public function getPorUsuarioContrasenia($username, $password) {
		$query = $this->_entityManager->createQuery("SELECT u FROM App_Model_User u WHERE u._usuario = '" . $username . "' and u._contrasenia LIKE'" . $password . "'");
		$arrayResult = $query->getResult();

		if ($arrayResult != null) {
			return $arrayResult[0];
		} else {
			return null;
		}
	}
	
	
}
