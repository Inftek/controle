<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 30/03/16
 * Time: 18:30
 */

namespace MRS\ControleBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class KilometragemRepository extends EntityRepository
{

    private function getConnection()
    {
        return $this->getEntityManager()
                    ->getConnection();
    }

    public function findTudoQueEuQuero()
    {
         return $this->findAll();
    }

    public function souZicaMesmoEDai()
    {
        return $this->findTudoQueEuQuero();

    }


    public function getAllDQL()
    {

        return $this->getEntityManager()
            ->createQuery("SELECT k FROM MRSControleBundle:TbKilometragem k")
            ->getResult();

    }

    public function getAllNativeQuery()
    {
        return $this->getConnection()
                    ->fetchAll('SELECT * FROM tb_kilometragem');
    }

    public function getAllQueryBuilder()
    {
        return $this->createQueryBuilder('k')
            ->select()
            ->getQuery()
            ->getResult();
    }

    public function getCalcKilometragem()
    {
        return $this->getConnection()->fetchAll('SELECT ki_codigo AS kiCodigo, concat(ki_kilometragem,\' KM\') AS kiKilometragem,
						date_format(ki_data_inicial,\'%d-%m-%Y\') AS kiDataInicial,
						date_format(ki_data_atual,\'%d-%m-%Y\') AS kiDataAtual,
						DATEDIFF(ki_data_atual,ki_data_inicial) Dias,
					    substr(ki_kilometragem / DATEDIFF(ki_data_atual,ki_data_inicial),1,7) Media
					FROM tb_kilometragem');
    }
}