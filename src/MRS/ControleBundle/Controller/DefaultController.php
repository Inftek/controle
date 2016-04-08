<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MRSControleBundle:Default:index.html.twig', array('name' => $name));
    }



    /**
     * @Route("/horarioregister", name="horario_register")
     * @Method({"POST","GET"})
     */
    public function registerButtonAction()
    {

        $entity = $this->get('horario.register')
                      ->registerHorario();

        /*
        $response = $this->get('serializer')
                         ->serialize($entity,'json');

        return new Response($response);
        */
//
//        if(!$entity){
//
//        }

        return $this->redirect($this->generateUrl('horario'));


    }


    /**
     * @return Response
     * @Route("/sendmail", name="send_email")
     */
    public function sendMailAction()
    {

        $Message = \Swift_Message::newInstance();

            $Message->setSubject('Hello Marcio')
                ->setFrom('marcio.santos@ceadis.org.br')
                ->setTo('marcio.santos@ceadis.org.br')
                ->setBody('TESTE TESTE TESTE');


        $Email = $this->get('mailer')->send($Message);


        return new Response('Lindo Funcionando '. $Message);
    }

}
