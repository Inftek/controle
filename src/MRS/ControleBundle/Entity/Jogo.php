<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jogo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MRS\ControleBundle\Repository\JogoRepository")
 */
class Jogo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inclusao", type="datetime")
     */
    private $dataInclusao;


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
     * Set numero
     *
     * @param string $numero
     *
     * @return Jogo
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dataInclusao
     *
     * @param \DateTime $dataInclusao
     *
     * @return Jogo
     */
    public function setDataInclusao($dataInclusao)
    {
        $this->dataInclusao = $dataInclusao;

        return $this;
    }

    /**
     * Get dataInclusao
     *
     * @return \DateTime
     */
    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }
}

