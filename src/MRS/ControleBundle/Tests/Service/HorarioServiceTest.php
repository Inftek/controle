<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 01/04/16
 * Time: 18:09
 */

namespace MRS\ControleBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use MRS\ControleBundle\Entity\TbHorario;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class HorarioService
{
    //private $entity;
    private $container;
    private $entityManager;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }


    private function queryHorario($coluna,$data)
    {
        return $this->entityManager
                    ->getRepository('MRSControleBundle:TbHorario')
                    ->getDataByColum($coluna, $data);

    }

    public function registerHorario()
    {
        $horario ='';

        $dataAtual = date('Y-m-d');
        $hora = date('H:i:s');

        $horaObj = new \DateTime('now');

        $entity = $this->queryHorario('hor_data',$dataAtual);

        if ($entity['hor_data'] == '') {

            $horario = new TbHorario();
            $horario->setHorDiaSemana(date('D'));
            $horario->setHorData($horaObj);
            $horario->setHorEntrada($horaObj);

            $this->entityManager->persist($horario);
            $this->entityManager->flush();

        } else {

            if (($entity['hor_entrada'] != '') and ($entity['hor_almoco_ida'] == '')) {

                $horario = $this->getEntity($entity['hor_codigo']);

                $horario->setHorAlmocoIda($horaObj);

                $this->entityManager->flush();

            } else {
                if (($entity['hor_almoco_ida'] != '') and ($entity['hor_almoco_volta'] == '')) {


                    $horario = $this->getEntity($entity['hor_codigo']);
                    $horario->setHorAlmocoVolta($horaObj);
                    $this->entityManager->flush();


                } else {
                    if (($entity['hor_almoco_volta'] != '') and ($entity['hor_saida'] == '')) {

                        $horario = $this->getEntity($entity['hor_codigo']);

                        $horario->setHorSaida($horaObj);

                        $this->entityManager->flush();
                    }
                }
            }
        }

        return $horario;


    }


    private function getById($id)
    {

        return $this->entityManager
                    ->getRepository('MRSControleBundle:TbHorario')
                    ->getById($id);

    }


    private function getEntity($id)
    {
        return $this->entityManager->getRepository('MRSControleBundle:TbHorario')->find($id);

        /*return $this->container
                    ->get('doctrine')
                    ->getManager()
                    ->getRepository('MRSControleBundle:TbHorario')
                    ->find($id);
*/

    }

/*
    public function registerHorario()
    {
        $coluna = 'hor_data';
        $data = date('Y-m-d');
        //return 'Deu certo ' . get_class($this);

        //return $this->entityManager->getRepository('MRSControleBundle:TbHorario')->getDataByColum($coluna, $data);

        return $this->queryHorario($coluna,$data);

        //return $this->getEntity(1);

    }


    /*
    public function registerHorario()
    {
        $horario = new TbHorario();
        $time = new \DateTime('now');
        $horario->setHorData($time)
            ->setHorDiaSemana(date('D'))
            ->setHorEntrada($time)
            ->setHorAlmocoIda($time)
            ->setHorAlmocoVolta($time)
            ->setHorSaida($time);

        $this->entityManager->persist($horario);
        $this->entityManager->flush();

    }
*/
}