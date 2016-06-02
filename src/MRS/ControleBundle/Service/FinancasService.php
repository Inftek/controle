<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 22/10/15
 * Time: 12:44
 */

namespace MRS\ControleBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FinancasService
{
    private $container;


    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function pegarFinancasResultQuery()
    {
        return $this->container->get('database_connection')
                               ->fetchAll('SELECT * FROM tb_financas AS F');
    }


    public function fazerUmtrampo()
    {
        return $this->container->get('database_connection')
                    ->fetchAll('SELECT FIN.fin_data_cadastro, FIN.fin_valor, CAT.cat_descricao
                                  FROM tb_financas AS FIN
                                  INNER JOIN tb_categoria AS CAT
                                  ON FIN.cat_codigo = CAT.cat_codigo
                                  GROUP BY FIN.fin_codigo');

    }

    public function sumTotalCostOnPeriod($dateInitial, $dateFinal)
    {
        $dateInitial = ($dateInitial == '') ? '2015-01-01' : $dateInitial;
        $dateFinal = ($dateFinal == '') ? date('Y-m-d') : $dateFinal;

        return $this->container->get('database_connection')
            ->executeQuery('SELECT sum(fin_valor) AS Total
                                  FROM tb_financas
                                  WHERE fin_data_cadastro >= ?
                                  AND   fin_data_cadastro <= ?',array($dateInitial,$dateFinal))
            ->fetch();

    }


    public function listarDadosFinanceirosPorPeriodo($dateInitial, $dateFinal)
    {
        $dateInitial = ($dateInitial == '') ? '2015-01-01' : $dateInitial;
        $dateFinal = ($dateFinal == '') ? date('Y-m-d') : $dateFinal;

        return $this->container->get('database_connection')
            ->executeQuery('SELECT FIN.fin_codigo AS finCodigo, FIN.fin_data_cadastro AS finDataCadastro,
                                   FIN.fin_valor AS finValor, FIN.fin_descricao AS finDescricao,
                                   CAT.cat_descricao AS catCodigo
                                  FROM tb_financas AS FIN
                                  INNER JOIN tb_categoria AS CAT
                                  ON FIN.cat_codigo = CAT.cat_codigo
                                  WHERE fin_data_cadastro >= ?
                                  AND   fin_data_cadastro <= ?',array($dateInitial,$dateFinal))
            ->fetchAll();

    }


}