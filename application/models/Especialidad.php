<?php
/**
 * especialidad
 * 
 * @Entity
 * @table(name="especialidad")
 */
class App_Model_Especialidad
{
	const ESPECIALIDAD = "especialidad";
	const SUBESPECIALIDAD = "subespecialidad";
	
    /**
	 *@var integer
	 * 
	 *@Column(name="id", type="integer", nullable=false)
	 *@id
	 *@GeneratedValue(strategy="IDENTITY")  
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
	 * @Column(name="tipo", type="string", length=100, nullable=true)
	 */
	private $_tipo;
	
	public function getId() {
		return $this->_id;
	}
	public function getNombre() {
		return $this->_nombre;
	}
	public function setNombre($nombre) {
		$this->_nombre = $nombre;
	}
	public function getTipo() {
		return $this->_tipo;
	}
	public function setTipo($tipo) {
		$this->_tipo = $tipo;
	}
	public function toArray() {
		return get_object_vars($this);
	}
}

