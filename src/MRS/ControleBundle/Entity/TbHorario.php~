<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbHorario
 *
 * @ORM\Table(name="tb_horario")
 * @ORM\Entity
 */
class TbHorario
{
    /**
     * @var string
     *
     * @ORM\Column(name="hor_dia_semana", type="string", length=20, nullable=true)
     */
    private $horDiaSemana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_data", type="date", nullable=true)
     */
    private $horData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_entrada", type="time", nullable=true)
     */
    private $horEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_almoco_ida", type="time", nullable=true)
     */
    private $horAlmocoIda;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_almoco_volta", type="time", nullable=true)
     */
    private $horAlmocoVolta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hor_saida", type="time", nullable=true)
     */
    private $horSaida;

    /**
     * @var string
     *
     * @ORM\Column(name="hor_justificativa", type="text", length=65535, nullable=true)
     */
    private $horJustificativa;

    /**
     * @var integer
     *
     * @ORM\Column(name="hor_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $horCodigo;



    /**
     * Set horDiaSemana
     *
     * @param string $horDiaSemana
     *
     * @return TbHorario
     */
    public function setHorDiaSemana($horDiaSemana)
    {
        $this->horDiaSemana = $horDiaSemana;

        return $this;
    }

    /**
     * Get horDiaSemana
     *
     * @return string
     */
    public function getHorDiaSemana()
    {
        return $this->horDiaSemana;
    }

    /**
     * Set horData
     *
     * @param \DateTime $horData
     *
     * @return TbHorario
     */
    public function setHorData($horData)
    {
        $this->horData = $horData;

        return $this;
    }

    /**
     * Get horData
     *
     * @return \DateTime
     */
    public function getHorData()
    {
        return $this->horData;
    }

    /**
     * Set horEntrada
     *
     * @param \DateTime $horEntrada
     *
     * @return TbHorario
     */
    public function setHorEntrada($horEntrada)
    {
        $this->horEntrada = $horEntrada;

        return $this;
    }

    /**
     * Get horEntrada
     *
     * @return \DateTime
     */
    public function getHorEntrada()
    {
        return $this->horEntrada;
    }

    /**
     * Set horAlmocoIda
     *
     * @param \DateTime $horAlmocoIda
     *
     * @return TbHorario
     */
    public function setHorAlmocoIda($horAlmocoIda)
    {
        $this->horAlmocoIda = $horAlmocoIda;

        return $this;
    }

    /**
     * Get horAlmocoIda
     *
     * @return \DateTime
     */
    public function getHorAlmocoIda()
    {
        return $this->horAlmocoIda;
    }

    /**
     * Set horAlmocoVolta
     *
     * @param \DateTime $horAlmocoVolta
     *
     * @return TbHorario
     */
    public function setHorAlmocoVolta($horAlmocoVolta)
    {
        $this->horAlmocoVolta = $horAlmocoVolta;

        return $this;
    }

    /**
     * Get horAlmocoVolta
     *
     * @return \DateTime
     */
    public function getHorAlmocoVolta()
    {
        return $this->horAlmocoVolta;
    }

    /**
     * Set horSaida
     *
     * @param \DateTime $horSaida
     *
     * @return TbHorario
     */
    public function setHorSaida($horSaida)
    {
        $this->horSaida = $horSaida;

        return $this;
    }

    /**
     * Get horSaida
     *
     * @return \DateTime
     */
    public function getHorSaida()
    {
        return $this->horSaida;
    }

    /**
     * Set horJustificativa
     *
     * @param string $horJustificativa
     *
     * @return TbHorario
     */
    public function setHorJustificativa($horJustificativa)
    {
        $this->horJustificativa = $horJustificativa;

        return $this;
    }

    /**
     * Get horJustificativa
     *
     * @return string
     */
    public function getHorJustificativa()
    {
        return $this->horJustificativa;
    }

    /**
     * Get horCodigo
     *
     * @return integer
     */
    public function getHorCodigo()
    {
        return $this->horCodigo;
    }
}
