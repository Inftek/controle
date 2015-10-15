<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

class TbFinancasRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByfinDataCadastro($param)
    {

        return $this->getEntityManager()
                    ->createQuery(
                        'SELECT f FROM MRSControleBundle:TbFinancas f ORDER BY f.fin_codigo'
                    )->getResult();

/*        return $this->getEntityManager()
                    ->createQuery()getRepository('MRSControleBundle:TbFinancas')
                    ->createQueryBuilder('f')
                    ->orderBy('f.finValor','desc')
                    ->getQuery()
                    ->getResult();
*/

    }


}