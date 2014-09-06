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
	 *@var array 
	 *
	 * @ManyToMany(targetEntity="App_Model_Especialidad", inversedBy="_contactos")
	 * @JoinTable(name="contacto_especialidad")
	 */
	 private $_especialidades;
		   
	public function __construct() {
	   	$this->_telefonos = array();
	   	$this->_especialidades = array();
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
	public function getApellidos() {
		return $this->_apellidos;
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
	public function agregarEspecialidad(App_Model_Especialidad $especialidad) {
		$especialidad->agregarContacto($this);
		$this->_especialidades[] = $especialidad;
	}
}
    