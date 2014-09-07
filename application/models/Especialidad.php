<?php
/**
 * especialidad
 * 
 * @Entity
 * @table(name="especialidad")
 */
class App_Model_Especialidad
{
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
	 * @Column(name="descripcion", type="string", length=100, nullable=true)
	 */
	private $_descripcion;

}

