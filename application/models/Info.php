<?php
/**
 * Contacto
 * 
 * @Entity
 * @table(name="info")
 * 
 */
class App_Model_Info
{
	/**
	* @var integer
	* 
	* @Column(name="id", type="integer", nullable=false)
	* @id
	* @GeneratedValue(strategy="IDENTITY")
	* 
	*/
	private $_id;
	/**
	* @var string
	* 
	* @Column(name="nombre", type="string", length=100, nullable=false)
	*/
	private $_nombre;
	/**
	* @var string
	* 
	* @Column(name="descripcion", type="string", length=900, nullable=false)
	*/
	private $_descripcion;
	
	public function getId() {
		return $this->_id;
	}
	
	public function getNombre() {
		return $this->_nombre;
	}
	public function setNombre($nombre) {
		$this->_nombre = $nombre;
	}
	
	public function getDescripcion() {
		return $this->_descripcion;
	}
	public function setDescripcion($descripcion) {
		$this->_descripcion = $descripcion;
	}
	public function toArray() {
		return get_object_vars($this);
	}
}
