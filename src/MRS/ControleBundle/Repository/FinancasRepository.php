<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

class FinancasRepository extends \Doctrine\ORM\EntityRepository
{

    public function meuMetodo()
    {
        return $this->getEntityManager()
                    ->getRepository('MRSControleBundle:TbFinancas')
                    ->findAll()
                    ->getQuery()
                    ->getResult();

    }


}