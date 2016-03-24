<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;
use Doctrine\ORM\EntityRepository;

class TbFinancasRepository extends EntityRepository
{

    public function findAllInOrder()
    {

/*        return $this->getEntityManager()
                    ->createQuery(
                        'SELECT f FROM MRSControleBundle:TbFinancas f ORDER BY f.fin_codigo'
                    )->getResult();
*/

        return $this->getEntityManager()
                    ->getRepository('MRS\ControleBundle\Repository\TbFinancas')
                    ->createQueryBuilder('f')
                    ->orderBy('f.finValor','desc')
                    ->getQuery()
                    ->getResult();


    }


}