<?php
class App_Dao_ModificacionesDao 
{
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	public function guardar(App_Model_Modificaciones $modificaciones) {
		$this->_entityManager->persist($modificaciones);
		$this->_entityManager->flush();
	}
		
}