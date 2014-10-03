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
              /*  $this->_entityManager->find("App_Model_Contacto", $id);   */
                //$modificar = $this->_entityManager->find($id);
                //$modificar->setUpdated();
                //$contacto = $this->getContactoPorId($id);
                //$contacto->setId($id);
                $this->_entityManager->update($contacto);
                
		$this->_entityManager->persist($contacto);
		$this->_entityManager->flush();
              // return $this->render(array('contacto'=>$contacto));
        }
     /*           
                
                $em = $this->getDoctrine()->getEntityManager();

$articulo = $em->getRepository('MDWDemoBundle:Articles')->find($id);

$articulo->setTitle('Articulo de ejemplo 1 - modificado');
$articulo->setUpdated(new \DateTime());

$em->persist($articulo);
$em->flush();

return $this->render('MDWDemoBundle:Articulos:articulo.html.twig', array('articulo' => $articulo));
                
                
       */         
	
        
	
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
	
	public function getAllLimitOffset($limit, $offset, $id, $idDepartamento)
	{
		$query = $this->_entityManager->createQuery("SELECT c FROM App_Model_Contacto c WHERE c._especialidad ='".$id."' AND c._departamento = '".$idDepartamento."'")
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
	}
	
}
