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

    public function findAllInOrder()
    {
        return $this->getEntityManager()
                    ->getRepository('MRSControleBundle:TbFinancas')
                    ->createQueryBuilder('f')
                    ->orderBy('f.finValor','desc')
                    ->getQuery()
                    ->getResult();

    }


}