<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbKilometragem
 *
 * @ORM\Table(name="tb_kilometragem")
 * @ORM\Entity
 */
class TbKilometragem
{
    /**
     * @var string
     *
     * @ORM\Column(name="ki_kilometragem", type="string", length=45, nullable=false)
     */
    private $kiKilometragem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ki_data_inicial", type="date", nullable=false)
     */
    private $kiDataInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ki_data_atual", type="date", nullable=false)
     */
    private $kiDataAtual;

    /**
     * @var integer
     *
     * @ORM\Column(name="ki_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $kiCodigo;



    /**
     * Set kiKilometragem
     *
     * @param string $kiKilometragem
     *
     * @return TbKilometragem
     */
    public function setKiKilometragem($kiKilometragem)
    {
        $this->kiKilometragem = $kiKilometragem;

        return $this;
    }

    /**
     * Get kiKilometragem
     *
     * @return string
     */
    public function getKiKilometragem()
    {
        return $this->kiKilometragem;
    }

    /**
     * Set kiDataInicial
     *
     * @param \DateTime $kiDataInicial
     *
     * @return TbKilometragem
     */
    public function setKiDataInicial($kiDataInicial)
    {
        $this->kiDataInicial = $kiDataInicial;

        return $this;
    }

    /**
     * Get kiDataInicial
     *
     * @return \DateTime
     */
    public function getKiDataInicial()
    {
        return $this->kiDataInicial;
    }

    /**
     * Set kiDataAtual
     *
     * @param \DateTime $kiDataAtual
     *
     * @return TbKilometragem
     */
    public function setKiDataAtual($kiDataAtual)
    {
        $this->kiDataAtual = $kiDataAtual;

        return $this;
    }

    /**
     * Get kiDataAtual
     *
     * @return \DateTime
     */
    public function getKiDataAtual()
    {
        return $this->kiDataAtual;
    }

    /**
     * Get kiCodigo
     *
     * @return integer
     */
    public function getKiCodigo()
    {
        return $this->kiCodigo;
    }
}
