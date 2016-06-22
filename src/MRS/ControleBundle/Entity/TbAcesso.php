<?php

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbAcesso
 *
 * @ORM\Table(name="tb_acesso")
 * @ORM\Entity
 */
class TbAcesso
{
    /**
     * @var string
     *
     * @ORM\Column(name="ace_usuario", type="string", length=45, nullable=false)
     */
    private $aceUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="ace_senha", type="string", length=40, nullable=false)
     */
    private $aceSenha;

    /**
     * @var string
     *
     * @ORM\Column(name="ace_ativo", type="string", length=1, nullable=false)
     */
    private $aceAtivo = 'S';

    /**
     * @var integer
     *
     * @ORM\Column(name="ace_codigo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aceCodigo;



    /**
     * Set aceUsuario
     *
     * @param string $aceUsuario
     *
     * @return TbAcesso
     */
    public function setAceUsuario($aceUsuario)
    {
        $this->aceUsuario = $aceUsuario;

        return $this;
    }

    /**
     * Get aceUsuario
     *
     * @return string
     */
    public function getAceUsuario()
    {
        return $this->aceUsuario;
    }

    /**
     * Set aceSenha
     *
     * @param string $aceSenha
     *
     * @return TbAcesso
     */
    public function setAceSenha($aceSenha)
    {
        $this->aceSenha = $aceSenha;

        return $this;
    }

    /**
     * Get aceSenha
     *
     * @return string
     */
    public function getAceSenha()
    {
        return $this->aceSenha;
    }

    /**
     * Set aceAtivo
     *
     * @param string $aceAtivo
     *
     * @return TbAcesso
     */
    public function setAceAtivo($aceAtivo)
    {
        $this->aceAtivo = $aceAtivo;

        return $this;
    }

    /**
     * Get aceAtivo
     *
     * @return string
     */
    public function getAceAtivo()
    {
        return $this->aceAtivo;
    }

    /**
     * Get aceCodigo
     *
     * @return integer
     */
    public function getAceCodigo()
    {
        return $this->aceCodigo;
    }
}
