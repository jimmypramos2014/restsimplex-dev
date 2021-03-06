<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * DetalleVenta
 *
 * @ORM\Table(name="detalle_venta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DetalleVentaRepository")
 */
class DetalleVenta
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
     * @ORM\Column(name="cantidad", type="float", nullable=true)
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=true)
     */
    private $precio;

    /**
     * @var float
     *
     * @ORM\Column(name="subtotal", type="float", nullable=true)
     */
    private $subtotal;

    /**
     * @ORM\ManyToOne(targetEntity="Venta", inversedBy="detalleVenta", cascade={"persist"})
     * @ORM\JoinColumn(name="venta_id", referencedColumnName="id")
     * 
     */
    protected $venta;

    /**
     * @ORM\ManyToOne(targetEntity="ProductoXLocal", inversedBy="detalleVenta", cascade={"persist"})
     * @ORM\JoinColumn(name="producto_x_local_id", referencedColumnName="id")
     * 
     */
    protected $productoXLocal;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=32, nullable=true)
     */
    private $condicion;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad_entregada", type="float", nullable=true)
     */
    private $cantidadEntregada;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_costo", type="float", nullable=true)
     */
    private $precioCosto;
    
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
     * Set cantidad
     *
     * @param float $cantidad
     *
     * @return DetalleVenta
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return DetalleVenta
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
     * Set venta
     *
     * @param \AppBundle\Entity\Venta $venta
     *
     * @return DetalleVenta
     */
    public function setVenta(\AppBundle\Entity\Venta $venta = null)
    {
        $this->venta = $venta;

        return $this;
    }

    /**
     * Get venta
     *
     * @return \AppBundle\Entity\Venta
     */
    public function getVenta()
    {
        return $this->venta;
    }

    /**
     * Set productoXLocal
     *
     * @param \AppBundle\Entity\ProductoXLocal $productoXLocal
     *
     * @return DetalleVenta
     */
    public function setProductoXLocal(\AppBundle\Entity\ProductoXLocal $productoXLocal = null)
    {
        $this->productoXLocal = $productoXLocal;

        return $this;
    }

    /**
     * Get productoXLocal
     *
     * @return \AppBundle\Entity\ProductoXLocal
     */
    public function getProductoXLocal()
    {
        return $this->productoXLocal;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return DetalleVenta
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
     * Set condicion
     *
     * @param string $condicion
     *
     * @return DetalleVenta
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get condicion
     *
     * @return string
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set cantidadEntregada
     *
     * @param float $cantidadEntregada
     *
     * @return DetalleVenta
     */
    public function setCantidadEntregada($cantidadEntregada)
    {
        $this->cantidadEntregada = $cantidadEntregada;

        return $this;
    }

    /**
     * Get cantidadEntregada
     *
     * @return float
     */
    public function getCantidadEntregada()
    {
        return $this->cantidadEntregada;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return DetalleVenta
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set precioCosto
     *
     * @param float $precioCosto
     *
     * @return DetalleVenta
     */
    public function setPrecioCosto($precioCosto)
    {
        $this->precioCosto = $precioCosto;

        return $this;
    }

    /**
     * Get precioCosto
     *
     * @return float
     */
    public function getPrecioCosto()
    {
        return $this->precioCosto;
    }
}
