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
	 * @var string
	 * @Column(name="descripcion", type="string", length=200, nullable=true)
	 */
	private $_descripcion;

}

