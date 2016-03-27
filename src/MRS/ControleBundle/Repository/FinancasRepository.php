<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FinancasRepository extends EntityRepository
{

    public function findAllfinValor()
    {

/*        return $this->getEntityManager()
                    ->createQuery('SELECT f FROM MRSControleBundle:TbFinancas')
                    ->getResult();*/

        return $this->findAll();

/*        return $this->getEntityManager()
            ->getRepository('MRSControleBundle:TbFinancas')
            ->createQueryBuilder('f')
            ->orderBy('f.finDataCadastro','DESC')
            ->getQuery()
            ->getResult();
        */

    }

/*    public function findByfinDataCadastro(array $datas = array())
    {
        return $this->getEnti nager()
                    ->createQueryBuilder('f')
                    ->where('f.finDataCadastro >= :dataInicial AND f.finDataCadastro <= :dataFinal')
                    ->setParameter('dataInicial',$datas[0])
                    ->setParameter('dataFinal',$datas[1])
                    ->orderBy('f.finDataCadastro','DESC')
                    ->getQuery()
                    ->getRet();

    }*/


}