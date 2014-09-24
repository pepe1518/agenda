<?php
/**
 * Contacto
 * 
 * @Entity
 * @table(name="contacto")
 * 
 */
class App_Model_Contacto
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
	* @Column(name="nombres", type="string", length=100, nullable=false)
	*/
	private $_nombres;
	  
	/**
	* @var string
	* 
	* @Column(name="apellidos", type="string", length=100, nullable=false)
	*/
	private $_apellidos;
	   
	/**
	* @var string
	* 
	* @Column(name="email", type="string", length=100, nullable=true)
	*/
	private $_email;
	
	/**
	 * @ManyToOne(targetEntity="App_Model_Departamento")
	 * @JoinColumn(name="departamento_id", referencedColumnName="id") 
	 */
	private $_departamento;
		
	/**
	* @var string
	* 
	* @Column(name="direccion", type="string", length=100, nullable=true)
	*/
	private $_direccion;
		 
	/**
	* @var blob
	* 
	* @Column(name="foto", type="blob", nullable=true)
	*/
	private $_foto;
		  
	/**
	* @var array
	* 
	* @OneToMany(targetEntity="App_Model_Telefono", mappedBy="_contacto", cascade={"all"})
	*/
	private $_telefonos;
	
	/**
	 *@ManyToOne(targetEntity="App_Model_Especialidad")
	 * @JoinColumn(name="especialidad_id", referencedColumnName="id") 
	 */
	 private $_especialidad;
	 	/**
	 *@ManyToOne(targetEntity="App_Model_Especialidad")
	 * @JoinColumn(name="subespecialidad_id", referencedColumnName="id") 
	 */
	 private $_subespecialidad;
		   
	public function __construct() {
	   	$this->_telefonos = array();
	   	
	}
		   
	public function agregarTelefono(App_Model_Telefono $telefono) {
    	$telefono->setContacto($this);
		$this->_telefonos[] = $telefono;    		   		
	}
	public function getId() {
		return $this->_id;
	} 
	public function getNombres() {
		return $this->_nombres;
	}
	public function setNombres($nombres) {
		$this->_nombres = $nombres;
	}
	public function getApellidos() {
		return $this->_apellidos;
	}
	public function setApellidos($apellidos) {
		$this->_apellidos = $apellidos;
	}
	public function getTelefonos() {
		return $this->_telefonos;
	}
	public function setEmail($email) {
		$this->_email = $email;
	}
	public function getEmail() {
		return $this->_email;
	}
	public function setFoto($foto) {
		$this->_foto = $foto;
	}
	public function getFoto() {
		return $this->_foto;
	}
	public function getEspecialidad() {
		return $this->_especialidad;
	}
	public function setEspecialidad(App_Model_Especialidad $especialidad) {
		$this->_especialidad = $especialidad;
	}
	public function getSubespecialidad() {
		return $this->_subespecialidad;
	}
	public function setSubespecialidad(App_Model_Especialidad $subespecialidad) {
		$this->_subespecialidad = $subespecialidad;
	}
	public function getDepartamento() {
		return $this->_departamento;
	} 
	public function setDepartamento(App_Model_Departamento $departamento) {
		$this->_departamento = $departamento;
	}	
		
	public function setDireccion($direccion) {
		$this->_direccion = $direccion;
	}
	
	
}
    