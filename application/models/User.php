<?php

/**
 * User
 *
 * @Entity
 * @Table(name="user")
 *
 */
class App_Model_User
{
	const ROL_ADMIN = "admin";
	const ROL_OBSERVADOR = "visitante";
	
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
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
	 * @Column(name="apellido", type="string", length=100, nullable=false) 
	 */
	 private $_apellido;
	 /**
	  * @var string
	  * 
	  * @Column(name="rol", type="string", length=100, nullable=false)
	  */
	 private $_rol;
	 
	 /**
	  * @var string
	  * 
	  * @Column(name="usuario", type="string", length=100, nullable=false)
	  */
	  private $_usuario;
	  
	  /**
	   * @var string
	   * 
	   * @column(name="contrasenia", type="string", length=100, nullable=false)
	   */
	   private $_contrasenia;
	   
   public function getId() {
       	return $this->_id;
	}
   public function setId($id) {
	   	$this->_id = $id;
   }
	   
   public function getNombre() {
	   	return $this->_nombre;
   }
   public function setNombre($nombre) {
        $this->_nombre = $nombre;
	}
   
   public function getApellido() {
	   	return $this->_apellido;
   }
   public function setApellido($apellido) {
        $this->_apellido = $apellido;
	}
    public function getUsuario() {
    	return $this->_usuario;
    }
	public function setUsusario($usuario) {
		$this->_usuario = $usuario;
	}
	
	public function getContrasenia() {
		return $this->_contrasenia;
	}
	public function setContrasenia($contrasenia) {
		$this->_contrasenia = $contrasenia;
	}
	
	public function toArray() {
		return get_object_vars($this);
	}
	
	public function toString() {
		$string = "Usuario: {";
        $string = $string . "<br />id: " . $this->_id;
        $string = $string . "<br />nombre: " . $this->_nombre;
		$string = $string . "<br />apellido: " . $this->_apellido;
        $string = $string . "<br />nombre de usuario: " . $this->_usuario;
        $string = $string . "<br />}";
        return $string;
	}
}

