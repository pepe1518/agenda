<?php
/**
 * Categoria
 * 
 * @Entity
 * @table(name="categoria")
 */
class App_Model_Categoria
{
	/**
	 * @var integer
	 * 
	 * @Column(name="id", type="integer", nullable=false)
	 * @id
	 *@GeneratedValue(strategy="IDENTITY") 
	 */
    private $_id;
	
	/**
	 * @var string
	 * @Column(name="nombre", type="string", length=200, nullable=false)
	 */
	private $_nombre;
	/**
	 * @ManyToOne(targetEntity="App_Model_Departamento")
	 * @JoinColumn(name="departamento_id", referencedColumnName="id") 
	 */
	private $_departamento;
       
	public function getId() {
		return $this->_id;
	}
	public function getNombre() {
		return $this->_nombre;
	}
	public function setNombre($nombre) {
		$this->_nombre = $nombre;
	}
	public function getDepartamento() {
		return $this->_departamento;
	} 
	public function setDepartamento(App_Model_Departamento $departamento) {
		$this->_departamento = $departamento;
	}
}

