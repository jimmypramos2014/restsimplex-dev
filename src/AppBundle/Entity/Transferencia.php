<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transferencia
 *
 * @ORM\Table(name="transferencia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransferenciaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Transferencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="subtotal", type="float", nullable=true)
     */
    private $subtotal;


    /**
     * @ORM\ManyToOne(targetEntity="EmpresaLocal", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="local_inicio", referencedColumnName="id")
     * 
     */
    protected $local_inicio;

    /**
     * @ORM\ManyToOne(targetEntity="EmpresaLocal", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="local_fin", referencedColumnName="id")
     * 
     */
    protected $local_fin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=true)
     */
    private $descripcion;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=32,nullable=true)
     * 
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=32,nullable=true)
     * 
     */
    private $numeroDocumento;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * 
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="MotivoTraslado", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="motivo_traslado_id", referencedColumnName="id")
     * 
     */
    protected $motivoTraslado;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     * 
     */
    protected $empresa;

    /**
     * @ORM\OneToOne(targetEntity="TransferenciaXTransporte", mappedBy="transferencia")
     */
    private $transferenciaXTransporte;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;
    
     /**
     * @ORM\OneToMany(targetEntity="TransferenciaXProducto", mappedBy="transferencia" , cascade={"persist", "remove"})
     */
    protected $transferenciaXProducto;

    /**
     * @ORM\ManyToOne(targetEntity="PedidoVenta", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="pedido_venta_id", referencedColumnName="id")
     * 
     */
    protected $pedidoVenta;

    /**
     * @ORM\ManyToOne(targetEntity="FacturaVenta", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="factura_venta_id", referencedColumnName="id")
     * 
     */
    protected $facturaVenta;

    /**
     * @ORM\ManyToOne(targetEntity="FacturaCompra", inversedBy="transferencia", cascade={"persist"})
     * @ORM\JoinColumn(name="factura_compra_id", referencedColumnName="id")
     * 
     */
    protected $facturaCompra;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="GuiaRemision", mappedBy="transferencia")
     */
    private $guiaRemision;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario", inversedBy="caja", cascade={"persist"})
     * @ORM\JoinColumn(name="usuario_creacion", referencedColumnName="id")
     */
    private $usuarioCreacion;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario", inversedBy="caja", cascade={"persist"})
     * @ORM\JoinColumn(name="usuario_modificacion", referencedColumnName="id")
     */
    private $usuarioModificacion;

    /** 
     * created Time/Date 
     * 
     * @var \DateTime 
     * 
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true) 
     */  
    protected $fechaCreacion;  
  
    /** 
     * updated Time/Date 
     * 
     * @var \DateTime 
     * 
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=true) 
     */  
    protected $fechaModificacion;  


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transferenciaXProducto = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function setUsuarioCreacion()
    {
        $usuario = $GLOBALS['kernel']->getContainer()->get('security.token_storage')->getToken()->getUser();
        $this->usuarioCreacion = $usuario;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUsuarioModificacion()
    {
        $usuario = $GLOBALS['kernel']->getContainer()->get('security.token_storage')->getToken()->getUser();
        $this->usuarioModificacion = $usuario;

    }

    /** 
     * Set FechaCreacion 
     * 
     * @ORM\PrePersist 
     */  
    public function setFechaCreacion()  
    {  
        $this->fechaCreacion = new \DateTime();  
        $this->fechaModificacion = new \DateTime();  
    }  
  
    /** 
     * Set FechaModificacion 
     * 
     * @ORM\PreUpdate 
     */  
    public function setFechaModificacion()  
    {  
        $this->fechaModificacion = new \DateTime();  
    }  

    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return Transferencia
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Transferencia
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Transferencia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Transferencia
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     *
     * @return Transferencia
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Transferencia
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set localInicio
     *
     * @param \AppBundle\Entity\EmpresaLocal $localInicio
     *
     * @return Transferencia
     */
    public function setLocalInicio(\AppBundle\Entity\EmpresaLocal $localInicio = null)
    {
        $this->local_inicio = $localInicio;

        return $this;
    }

    /**
     * Get localInicio
     *
     * @return \AppBundle\Entity\EmpresaLocal
     */
    public function getLocalInicio()
    {
        return $this->local_inicio;
    }

    /**
     * Set localFin
     *
     * @param \AppBundle\Entity\EmpresaLocal $localFin
     *
     * @return Transferencia
     */
    public function setLocalFin(\AppBundle\Entity\EmpresaLocal $localFin = null)
    {
        $this->local_fin = $localFin;

        return $this;
    }

    /**
     * Get localFin
     *
     * @return \AppBundle\Entity\EmpresaLocal
     */
    public function getLocalFin()
    {
        return $this->local_fin;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Transferencia
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set motivoTraslado
     *
     * @param \AppBundle\Entity\MotivoTraslado $motivoTraslado
     *
     * @return Transferencia
     */
    public function setMotivoTraslado(\AppBundle\Entity\MotivoTraslado $motivoTraslado = null)
    {
        $this->motivoTraslado = $motivoTraslado;

        return $this;
    }

    /**
     * Get motivoTraslado
     *
     * @return \AppBundle\Entity\MotivoTraslado
     */
    public function getMotivoTraslado()
    {
        return $this->motivoTraslado;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Transferencia
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set transferenciaXTransporte
     *
     * @param \AppBundle\Entity\TransferenciaXTransporte $transferenciaXTransporte
     *
     * @return Transferencia
     */
    public function setTransferenciaXTransporte(\AppBundle\Entity\TransferenciaXTransporte $transferenciaXTransporte = null)
    {
        $this->transferenciaXTransporte = $transferenciaXTransporte;

        return $this;
    }

    /**
     * Get transferenciaXTransporte
     *
     * @return \AppBundle\Entity\TransferenciaXTransporte
     */
    public function getTransferenciaXTransporte()
    {
        return $this->transferenciaXTransporte;
    }

    /**
     * Add transferenciaXProducto
     *
     * @param \AppBundle\Entity\TransferenciaXProducto $transferenciaXProducto
     *
     * @return Transferencia
     */
    public function addTransferenciaXProducto(\AppBundle\Entity\TransferenciaXProducto $transferenciaXProducto)
    {
        $this->transferenciaXProducto[] = $transferenciaXProducto;

        return $this;
    }

    /**
     * Remove transferenciaXProducto
     *
     * @param \AppBundle\Entity\TransferenciaXProducto $transferenciaXProducto
     */
    public function removeTransferenciaXProducto(\AppBundle\Entity\TransferenciaXProducto $transferenciaXProducto)
    {
        $this->transferenciaXProducto->removeElement($transferenciaXProducto);
    }

    /**
     * Get transferenciaXProducto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransferenciaXProducto()
    {
        return $this->transferenciaXProducto;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Get usuarioCreacion
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    /**
     * Get usuarioModificacion
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    /**
     * Set pedidoVenta
     *
     * @param \AppBundle\Entity\PedidoVenta $pedidoVenta
     *
     * @return Transferencia
     */
    public function setPedidoVenta(\AppBundle\Entity\PedidoVenta $pedidoVenta = null)
    {
        $this->pedidoVenta = $pedidoVenta;

        return $this;
    }

    /**
     * Get pedidoVenta
     *
     * @return \AppBundle\Entity\PedidoVenta
     */
    public function getPedidoVenta()
    {
        return $this->pedidoVenta;
    }

    /**
     * Set facturaVenta
     *
     * @param \AppBundle\Entity\FacturaVenta $facturaVenta
     *
     * @return Transferencia
     */
    public function setFacturaVenta(\AppBundle\Entity\FacturaVenta $facturaVenta = null)
    {
        $this->facturaVenta = $facturaVenta;

        return $this;
    }

    /**
     * Get facturaVenta
     *
     * @return \AppBundle\Entity\FacturaVenta
     */
    public function getFacturaVenta()
    {
        return $this->facturaVenta;
    }

    /**
     * Add guiaRemision
     *
     * @param \AppBundle\Entity\GuiaRemision $guiaRemision
     *
     * @return Transferencia
     */
    public function addGuiaRemision(\AppBundle\Entity\GuiaRemision $guiaRemision)
    {
        $this->guiaRemision[] = $guiaRemision;

        return $this;
    }

    /**
     * Remove guiaRemision
     *
     * @param \AppBundle\Entity\GuiaRemision $guiaRemision
     */
    public function removeGuiaRemision(\AppBundle\Entity\GuiaRemision $guiaRemision)
    {
        $this->guiaRemision->removeElement($guiaRemision);
    }

    /**
     * Get guiaRemision
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuiaRemision()
    {
        return $this->guiaRemision;
    }

    /**
     * Set facturaCompra
     *
     * @param \AppBundle\Entity\FacturaCompra $facturaCompra
     *
     * @return Transferencia
     */
    public function setFacturaCompra(\AppBundle\Entity\FacturaCompra $facturaCompra = null)
    {
        $this->facturaCompra = $facturaCompra;

        return $this;
    }

    /**
     * Get facturaCompra
     *
     * @return \AppBundle\Entity\FacturaCompra
     */
    public function getFacturaCompra()
    {
        return $this->facturaCompra;
    }
}
