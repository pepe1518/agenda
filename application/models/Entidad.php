<?php
/**
 *Entidad
 * 
 *@Entity
 *@table(name="entidad")
 */
class App_Model_Entidad
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
	 * 
	 * @Column(name="nombre", type="string", length=100, nullable=false)
	 */
    private $_nombre;
	
	/**
	 * @var string
	 * 
	 * @Column(name="encargado", type="string", length=200, nullable=false)
	 */
	private $_encargado;
	/**
	 * @ManyToOne(targetEntity="App_Model_Categoria")
	 * @JoinColumn(name="categoria_id", referencedColumnName="id") 
	 */
	private $_categoria;
	
	/**
	 * @var string
	 * 
	 * @Column(name="direccion", type="string", length=200, nullable=true)
	 */
	 
	private $_direccion;

	/**
	 * @ManyToOne(targetEntity="App_Model_Telefono")
	 * @JoinColumn(name="telefono_id", referencedColumnName="id") 
	 */
	private $_telefono;
	/**
	* @var blob
	* 
	* @Column(name="foto", type="blob", nullable=true)
	*/
	private $_foto;
	
	/**
	 *@ManyToOne(targetEntity="App_Model_Especialidad")
	 * @JoinColumn(name="especialidad_id", referencedColumnName="id") 
	 */
	 private $_especialidad;
	  
	public function getId() {
		return $this->_id;
	}
	public function getNombre(){
		return $this->_nombre;
	}
	public function setNombre($nombre) {
		$this->_nombre = $nombre;
	}
	public function getEncargado() {
		return $this->_encargado;
	}
	public function setEncargado($encargado) {
		$this->_encargado = $encargado;
	}
	public function getCategoria() {
		return $this->_categoria;
	} 
	public function setCategoria(App_Model_Categoria $categoria) {
		$this->_categoria = $categoria;
	}
	
	public function getDireccion() {
		return $this->_direccion;
	}
	public function setDireccion($direccion) {
		$this->_direccion = $direccion;
	}
	public function getTelefono() {
		return $this->_telefono;
	}
	public function setTelefono(App_Model_Telefono $telefono) {
		$this->_telefono = $telefono;
	}
	public function setEspecialidad(App_Model_Especialidad $especialidad) {
		$this->_especialidad = $especialidad;
	}
		public function setUltimaModificacion($date) {
		$this->_ultimaModificacion = $date;
	}
	public function getEspecialidad() {
		return $this->_especialidad;
	}
	
	public function setFoto($foto) {
		$this->_foto = $foto;
	}
	public function getFoto() {
		return $this->_foto;
	}
        
        public function toArray() {
		return get_object_vars($this);
	}

}

