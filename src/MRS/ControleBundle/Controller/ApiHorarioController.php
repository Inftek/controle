<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiHorarioController extends Controller
{
    /**
     * @Route("/listHorario")
     */
    public function listHorarioAction()
    {
        $dados = $this->getDoctrine()
                      ->getRepository('MRSControleBundle:TbHorario')
                      ->listAllHorario();


        $dados = $this->container
                      ->get('serializer')
                      ->serialize($dados,'json');

        $response = new Response();
        //return new Response($dados,'200',array('content-type'=>'application/json'));

        $response->headers
            ->set('X-Enterprise-By','MRS4 Tecnologia');

        $response->headers
                 ->set('content-type','application/json');

        //$response->setContent($dados);

        return $this->render('@MRSControle/ApiHorario/listHorario.html.twig',
                            ['dados' => $dados],
                            $response);

       //return array('dados' => $dados);

    }

}
