<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TbCategoria
 *
 * @ORM\Table(name="tb_categoria")
 * @ORM\Entity
 */
class TbCategoria
{
    /**
     * @var string
     *
     * @ORM\Column(name="cat_descricao", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="Nao pode ser vazio to CREATE", groups={"create","update"})
     * @Assert\Length(min=3,minMessage="Nao pode ser menor to UPDATE", groups={"create","update"})
     */
    private $catDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_ativo", type="string", length=1, nullable=false)
     * @Assert\NotBlank(message="Nao vazio",groups={"update","create"})
     */
    private $catAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catCodigo;



    /**
     * Set catDescricao
     *
     * @param string $catDescricao
     *
     * @return TbCategoria
     */
    public function setCatDescricao($catDescricao)
    {
        $this->catDescricao = $catDescricao;

        return $this;
    }

    /**
     * Get catDescricao
     *
     * @return string
     */
    public function getCatDescricao()
    {
        return $this->catDescricao;
    }

    /**
     * Set catAtivo
     *
     * @param string $catAtivo
     *
     * @return TbCategoria
     */
    public function setCatAtivo($catAtivo)
    {
        $this->catAtivo = $catAtivo;

        return $this;
    }

    /**
     * Get catAtivo
     *
     * @return string
     */
    public function getCatAtivo()
    {
        return $this->catAtivo;
    }

    /**
     * Get catCodigo
     *
     * @return integer
     */
    public function getCatCodigo()
    {
        return $this->catCodigo;
    }

    public function getId()
    {
        return $this->catCodigo;
    }

    public function __toString()
    {
        return $this->getCatDescricao();
    }
}
