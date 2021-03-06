<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleProforma
 *
 * @ORM\Table(name="detalle_proforma")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DetalleProformaRepository")
 */
class DetalleProforma
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
     * @ORM\ManyToOne(targetEntity="Proforma", inversedBy="detalleProforma", cascade={"persist"})
     * @ORM\JoinColumn(name="proforma_id", referencedColumnName="id")
     * 
     */
    protected $proforma;

    /**
     * @ORM\ManyToOne(targetEntity="ProductoXLocal", inversedBy="detalleProforma", cascade={"persist"})
     * @ORM\JoinColumn(name="producto_x_local_id", referencedColumnName="id")
     * 
     */
    protected $productoXLocal;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad_entregada", type="float", nullable=true)
     */
    private $cantidadEntregada;

    /**
     * Get id
     *
     * @return int
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
     * @return DetalleProforma
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
     * Set precio
     *
     * @param float $precio
     *
     * @return DetalleProforma
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
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return DetalleProforma
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
     * Set proforma
     *
     * @param \AppBundle\Entity\Proforma $proforma
     *
     * @return DetalleProforma
     */
    public function setProforma(\AppBundle\Entity\Proforma $proforma = null)
    {
        $this->proforma = $proforma;

        return $this;
    }

    /**
     * Get proforma
     *
     * @return \AppBundle\Entity\Proforma
     */
    public function getProforma()
    {
        return $this->proforma;
    }

    /**
     * Set productoXLocal
     *
     * @param \AppBundle\Entity\ProductoXLocal $productoXLocal
     *
     * @return DetalleProforma
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
     * Set cantidadEntregada
     *
     * @param float $cantidadEntregada
     *
     * @return DetalleProforma
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
}
