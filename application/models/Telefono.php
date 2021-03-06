<?php
/**
 * Telefono
 * 
 * @Entity
 * @table(name="telefono")
 * 
 */
class App_Model_Telefono
{
	const TELEFONO_TRABAJO = "Trabajo";
	const TELEFONO_CASA = "Domicilio";
	const TELEFONO_CELULAR = "Celular";
	 
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
	  * @column(name="numero", type="integer", nullable=false)
	  */
	  private $_numero;
	  
	/**
	 * @var string 
	 * 
	 * @Column(name="tipo", type="string", length=30, nullable=true)
	 */
    private $_tipo;
	  
	/**
	 * @ManyToOne(targetEntity="App_Model_Contacto", inversedBy="_telefonos", cascade={"all"})
	 * @JoinColumn(name="contacto_id", referencedColumnName="id")
	 */
	 private $_contacto;	  
	  
	  public function __construct($numero) {
	  	$this->setNumero($numero);
	  }
	  
	  public function getId() {
	  	return $this->_id;
	  }
	  
	  public function getNumero() {
	  	return $this->_numero;
	  }
	  
	  public function setNumero($numero) {
	  	$this->_numero = $numero;
	  }
	  
	  public function setContacto(App_Model_Contacto $contacto) {
	  	$this->_contacto = $contacto;
	  }
	  public function getTipo() {
	  	return $this->_tipo;
	  }
	  public function setTipo($tipo) {
	  	$this->_tipo = $tipo;
	  }
}
