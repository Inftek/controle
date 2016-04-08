<?php

/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 07/10/15
 * Time: 18:11
 */

namespace MRS\ControleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class JogoRepository extends EntityRepository
{


    public function getOqueEuQuero()
    {
        return $this->findAll();
    }


}