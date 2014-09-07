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
	 * @OneToOne(targetEntity="App_Model_Categoria")
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
	 * @OneToOne(targetEntity="App_Model_Telefono")
	 * @JoinColumn(name="telefono_id", referencedColumnName="id") 
	 */
	private $_telefono;

}

