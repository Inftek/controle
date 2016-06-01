<?php
/**
 * Created by PhpStorm.
 * User: mrs4
 * Date: 17/05/16
 * Time: 18:35
 */

namespace MRS\ControleBundle\Service;


use MRS\ControleBundle\Entity\Jogo;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JogoService
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    private function seqNumber()
    {
        $a = array();

        for ($x = 1; $x <= 60; $x++) {
            $a[] = $x;
        }
        return $a;
    }

    private function saveNumber(Jogo $jogo)
    {

        $em = $this->container
                   ->get('doctrine')
                   ->getManager();

        $em->persist($jogo);
        $em->flush();

    }

    public function generateNumber()
    {

        $jogo = new Jogo();

        $a = $this->seqNumber();

        inicio:

        $array = array();

        $y = 1;

        for ( ; ; ):

            shuffle($a);

            $x = 0;

            foreach ($a as $valor) {
                $b[] = $valor;
                $x++;
                if ($x == 6) {
                    break;
                }
            }

            sort($b);

            if (!in_array($b, $array)) {
                $array[] = $b;

                $numero = implode('-', $b);

                try {

                    $jogo->setNumero($numero)
                         ->setDataInclusao(new \DateTime('now'));

                    $this->saveNumber($jogo);

                } catch (\PDOException $e) {
                    unset($b);
                    goto inicio;
                }
            } else {
                return 'Tem no array';
                continue;

            }

            return $y . ' | ' . $numero;
            continue;


            unset($b);

            $y++;

        endfor;
    }

}