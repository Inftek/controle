<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProductRepository extends EntityRepository
{


    public function getMaxIdProduct()
    {

        $sql = "select max(id) as 'max' from tb_product";

        $stmt = $this->getEntityManager()
                     ->getConnection()
                     ->prepare($sql);

        $stmt->execute();

        $max =  $stmt->fetch(\PDO::FETCH_ASSOC);

        return $max['max']+1;
    }


}