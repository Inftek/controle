<?php

namespace MRS\ControleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SerializerController extends Controller
{
    public function financasAction()
    {
        return $this->render('MRSControleBundle:SerializerController:financas.html.twig', array(
                // ...
            ));
    }

    /**
     * @return Response
     * @Route("/jsonfinancas", name="jsonfinancas")
     */

    public function jsonFinancas()
    {
        $Entity = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('MRSControleBundle:TbFinancas')
                       ->findAll();

        $jsonEntity = $this->get('serializer')->serialize($Entity,'json');

        $response =  new Response($jsonEntity);

        $response->headers->set('ContentType','Application/json');

        return $response;

    }

}
