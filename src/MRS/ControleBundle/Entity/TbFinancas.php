<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TbFinancas
 *
 * @ORM\Table(name="tb_financas", indexes={@ORM\Index(name="fk_tipo_entrada", columns={"ten_codigo"}), @ORM\Index(name="fk_categoria", columns={"cat_codigo"})})
 * @ORM\Entity(repositoryClass="MRS\ControleBundle\Repository\FinancasRepository")
 */
class TbFinancas
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_data_cadastro", type="date", nullable=false)
     */
    private $finDataCadastro;

    /**
     * @var string
     *
     * @ORM\Column(name="fin_valor", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $finValor;

    /**
     * @var string
     *
     * @ORM\Column(name="fin_descricao", type="string", length=45, nullable=true)
     * @Assert\Length(min=5, minMessage="Precisa ter mais de 5 pra atualizar", groups={"update"})
     */
    private $finDescricao;

    /**
     * @var integer
     *
     * @ORM\Column(name="fin_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $finCodigo;

    /**
     * @var \MRS\ControleBundle\Entity\TbTipoEntrada
     *
     * @ORM\ManyToOne(targetEntity="MRS\ControleBundle\Entity\TbTipoEntrada")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ten_codigo", referencedColumnName="ten_codigo")
     * })
     * @Assert\NotBlank(message="Nao pode ser vazio", groups={"create"})
     */
    private $tenCodigo;

    /**
     * @var \MRS\ControleBundle\Entity\TbCategoria
     *
     * @ORM\ManyToOne(targetEntity="MRS\ControleBundle\Entity\TbCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cat_codigo", referencedColumnName="cat_codigo")
     * })
     * @Assert\NotBlank(message="Nao pode ser vazio", groups={"update"})
     */
    private $catCodigo;



    /**
     * Set finDataCadastro
     *
     * @param \DateTime $finDataCadastro
     *
     * @return TbFinancas
     */
    public function setFinDataCadastro($finDataCadastro)
    {
        $this->finDataCadastro = $finDataCadastro;

        return $this;
    }

    /**
     * Get finDataCadastro
     *
     * @return \DateTime
     */
    public function getFinDataCadastro()
    {
        return $this->finDataCadastro;
    }

    /**
     * Set finValor
     *
     * @param string $finValor
     *
     * @return TbFinancas
     */
    public function setFinValor($finValor)
    {
        $this->finValor = $finValor;

        return $this;
    }

    /**
     * Get finValor
     *
     * @return string
     */
    public function getFinValor()
    {
        return $this->finValor;
    }

    /**
     * Set finDescricao
     *
     * @param string $finDescricao
     *
     * @return TbFinancas
     */
    public function setFinDescricao($finDescricao)
    {
        $this->finDescricao = $finDescricao;

        return $this;
    }

    /**
     * Get finDescricao
     *
     * @return string
     */
    public function getFinDescricao()
    {
        return $this->finDescricao;
    }

    /**
     * Get finCodigo
     *
     * @return integer
     */
    public function getFinCodigo()
    {
        return $this->finCodigo;
    }

    /**
     * Set tenCodigo
     *
     * @param \MRS\ControleBundle\Entity\TbTipoEntrada $tenCodigo
     *
     * @return TbFinancas
     */
    public function setTenCodigo(\MRS\ControleBundle\Entity\TbTipoEntrada $tenCodigo = null)
    {
        $this->tenCodigo = $tenCodigo;

        return $this;
    }

    /**
     * Get tenCodigo
     *
     * @return \MRS\ControleBundle\Entity\TbTipoEntrada
     */
    public function getTenCodigo()
    {
        return $this->tenCodigo;
    }

    /**
     * Set catCodigo
     *
     * @param \MRS\ControleBundle\Entity\TbCategoria $catCodigo
     *
     * @return TbFinancas
     */
    public function setCatCodigo(\MRS\ControleBundle\Entity\TbCategoria $catCodigo = null)
    {
        $this->catCodigo = $catCodigo;

        return $this;
    }

    /**
     * Get catCodigo
     *
     * @return \MRS\ControleBundle\Entity\TbCategoria
     */
    public function getCatCodigo()
    {
        return $this->catCodigo;
    }

    public function getId()
    {
        return $this->finCodigo;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setValueValor()
    {
        $this->finValor = number_format($this->finValor,2,'.','');
    }

}
