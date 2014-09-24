<?php
/**
 * Departamento
 * 
 * @Entity
 * @table(name="departamento")
 */
class App_Model_Departamento
{
	/**
	 * @var integer
	 * 
	 * @column(name="id", type="integer", nullable=false)
	 * @id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	 private $_id;
	/**
	 * @var string
	 * 
	 * @column(name="nombre", type="string", nullable=false)
	 */
	private $_nombre;
	
	public function getId() {
		return $this->_id;
	}
	
	public function getNombre() {
		return $this->_nombre;
	}
}
