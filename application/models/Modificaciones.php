<?php
/**
 * Telefono
 * 
 * @Entity
 * @table(name="modificaciones")
 * 
 */
class App_Model_Modificaciones
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
	 * @var datetime
 	*
 	* @Column(name="ultima_modificacion", type="datetime", nullable=true)
 	*/
 	private $_ultimaModificacion;
	
	public function __construct(){
		date_default_timezone_set("America/La_Paz");
		$date = new DateTime();	
		$this->_ultimaModificacion = $date;
	}


}

