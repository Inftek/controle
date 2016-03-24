<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbTipoEntrada
 *
 * @ORM\Table(name="tb_tipo_entrada")
 * @ORM\Entity
 */
class TbTipoEntrada
{
    /**
     * @var string
     *
     * @ORM\Column(name="ten_descricao", type="string", length=45, nullable=false)
     */
    private $tenDescricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ten_ativo", type="string", length=1, nullable=false)
     */
    private $tenAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ten_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tenCodigo;



    /**
     * Set tenDescricao
     *
     * @param string $tenDescricao
     *
     * @return TbTipoEntrada
     */
    public function setTenDescricao($tenDescricao)
    {
        $this->tenDescricao = $tenDescricao;

        return $this;
    }

    /**
     * Get tenDescricao
     *
     * @return string
     */
    public function getTenDescricao()
    {
        return $this->tenDescricao;
    }

    /**
     * Set tenAtivo
     *
     * @param string $tenAtivo
     *
     * @return TbTipoEntrada
     */
    public function setTenAtivo($tenAtivo)
    {
        $this->tenAtivo = $tenAtivo;

        return $this;
    }

    /**
     * Get tenAtivo
     *
     * @return string
     */
    public function getTenAtivo()
    {
        return $this->tenAtivo;
    }

    /**
     * Get tenCodigo
     *
     * @return integer
     */
    public function getId()
    {
        return $this->tenCodigo;
    }

    public function __toString()
    {
        return $this->getTenDescricao();
    }
}
