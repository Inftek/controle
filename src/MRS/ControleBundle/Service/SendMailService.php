<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 22/10/15
 * Time: 12:44
 */

namespace MRS\ControleBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class SendMailService
{
    private $container;


    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function send($message)
    {
       return $this->container->get('mailer')->send($message);
    }



}