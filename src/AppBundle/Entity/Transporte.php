<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporte
 *
 * @ORM\Table(name="transporte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransporteRepository")
 */
class Transporte
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=11, nullable=true)
     */
    private $ruc;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="transporte", cascade={"persist"})
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     * 
     */
    protected $empresa;

    public function __toString()
    {
        return strtoupper($this->getNombre());
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Transporte
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ruc
     *
     * @param string $ruc
     *
     * @return Transporte
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;

        return $this;
    }

    /**
     * Get ruc
     *
     * @return string
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Transporte
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return bool
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Transporte
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
}
