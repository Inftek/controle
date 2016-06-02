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

    private function getEntity($id)
    {
        return $this->entityManager
            ->getRepository('MRSControleBundle:TbHorario')
            ->find($id);

    }

    public function registerHorario()
    {
        $horario = ['notice' => 'Todos os horarios do dia ja foram cadastrados'];

        $horaObj = new \DateTime('now');

        $entity = $this->queryHorario('hor_data',date('Y-m-d'));

        if ($entity['hor_data'] == '') {

            $horario = new TbHorario();
            $horario->setHorDiaSemana(date('D'));
            $horario->setHorData($horaObj);
            $horario->setHorEntrada($horaObj);

            $this->entityManager->persist($horario);
            $this->entityManager->flush();

            $horario = ['notice' => 'Inserido o primeiro horário do dia!'];

        } else {

            if (($entity['hor_entrada'] != '') && ($entity['hor_almoco_ida'] == '')) {

                $horario = $this->getEntity($entity['hor_codigo']);

                $horario->setHorAlmocoIda($horaObj);

                $this->entityManager->flush();

                $horario = ['notice' => 'Inserido saida do almoço!'];

            } else {
                if (($entity['hor_almoco_ida'] != '') && ($entity['hor_almoco_volta'] == '')) {


                    $horario = $this->getEntity($entity['hor_codigo']);
                    $horario->setHorAlmocoVolta($horaObj);
                    $this->entityManager->flush();

                    $horario = ['notice' => 'Inserido retorno do almoço!'];


                } else {
                    if (($entity['hor_almoco_volta'] != '') && ($entity['hor_saida'] == '')) {

                        $horario = $this->getEntity($entity['hor_codigo']);

                        $horario->setHorSaida($horaObj);

                        $this->entityManager->flush();

                        $horario = ['notice' => 'Inserido saída no fim do dia!'];
                    }
                }
            }
        }

        return $horario;


    }

}