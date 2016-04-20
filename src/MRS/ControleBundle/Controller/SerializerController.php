<?php
namespace MRS\ControleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SerializerController extends Controller
{
    /**
     * @return Response
     * @Route("/financastest", name="financas_test")
     */
    public function financasAction()
    {
        $entity = $this->get('financas.querynative')->pegarFinancasResultQuery();

        return $this->render('MRSControleBundle:SerializerController:financas.html.twig', array(
                'entity' => $entity
            ));
    }

    /**
     * @return Response
     * @Route("/jsonfinancas", name="jsonfinancas")
     */
    public function jsonFinancas()
    {
        $Entity = $this->get('financas.querynative')
                       ->fazerUmtrampo();

        //$jsonEntity = $this->get('serializer')->serialize($Entity,'json');

//        $response =  new Response($jsonEntity);
//
//        $response->headers->set('Content-Type','Application/json');
//
//        return $response;

        return new JsonResponse($Entity);

    }

    /**
     * @return \Doctrine\DBAL\Driver\Statement
     * @Route("/testesum", name="testesum")
     */
    public function viewTotalOnPeriodAction(Request $request)
    {

        //$this->denyAccessUnlessGranted('ROLE_ADMIN');

        $total = $this->get('financas.querynative')
                      ->sumTotalCostOnPeriod($request->get('dataInicial'),
                                             $request->get('dataFinal'));

        return new Response($total['Total']);
    }


}
