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
        $param = '';

        $Financas = $this->get('database_connection')
            ->fetchAll('SELECT *,(SELECT cat_descricao FROM tb_categoria WHERE cat_codigo = F.cat_codigo) AS cat_descricao
                        FROM tb_financas AS F');

        $Entity = $Financas;

/*        $Entity = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('MRS\ControleBundle\Entity\TbFinancas')
                       ->findAll();*/

        $jsonEntity = $this->get('serializer')->serialize($Entity,'json');

        $response =  new Response($jsonEntity);

        $response->headers->set('Content-Type','Application/json');

        return $response;

    }

}
