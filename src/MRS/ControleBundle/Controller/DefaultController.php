<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    /**
     * @return Response
     * @Route("/dashboard", name="dash_board")
     */
    public function indexAction()
    {

        return $this->render('MRSControleBundle:Default:index.html.twig',array(
            'pie' => $this->get('charts.service')->getPie(),
            'lines' => $this->get('charts.service')->getLines()
        ));
    }



    /**
     * @Route("/horarioregister", name="horario_register")
     * @Method({"POST","GET"})
     */
    public function registerButtonAction(Request $request)
    {

        $text = $this->get('horario.register')
                     ->registerHorario();

        $this->addFlash('notice',$text);

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
                ->setTo('wellington.junior@ceadis.org.br')
                ->addTo('marcio.santos@ceadis.org.br')
                ->addTo('marciomrs4@hotmail.com')
                ->addTo('marciomrs4@gmail.com')
                ->setBody(
                    $this->renderView('MRSControleBundle:Default:Email.html.twig',
                                        array('name' => rand(1,1000))),
                    'text/html');


        $Email = $this->get('mailer')->send($Message);


        return new Response('Lindo Funcionando ');
    }

    /**
     * @return Response
     * @Route("/testparameters", name="test_parameters")
     * @Method({"POST|GET|PUT|DELETE|PATCH"})
     */
    public function parameterAction(Request $request)
    {
        $method = $request->getRealMethod();
        $createdBy = $request->headers->get('X-Powered-By');
        $dados[] = $request->get('name');
        $dados[] = $request->get('idade');
        $dados[] = $request->get('cpf');
        $test = $this->container->getParameter('configuration.test.value');
        return new Response('Hello Sf2 ' . $test . ' Method: ' .$method . ' # ' . $createdBy . ' Dados: ' . implode(' ',$dados));
    }


    /**
     * @param Request $request
     * @return array
     * @Route("/listarhorario",name="listar_horario");
     */
    public function listHorarioAction(Request $request)
    {
        $date = new \DateTime();
        $datas[0] = ($request->get('dataInicial') == '') ? $date->modify('-30 day')->format('Y-m-d') : $request->get('dataInicial');

        $datas[1] = ($request->get('dataFinal') == '') ? date('Y-m-d') : $request->get('dataFinal');

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MRSControleBundle:TbHorario')
                        ->listarByPeriod($datas[0], $datas[1]);

        $paginator = $this->get('knp_paginator')->paginate(
                        $entities,
                        $request->query->getInt('page',1),$this->getParameter('knp_paginator.page_range')
        );


        return $this->render('MRSControleBundle:TbHorario:index2.html.twig',[
                    'entities' => $paginator,
                    'datas' => array('dataInicial' => $datas[0], 'dataFinal' => $datas[1]),
        ]);


    }

    /**
     * @Route("pdfroute",name="pdf_route")
     */
    public function generatePdfAction()
    {
        $name = 'Márcio';

        $html = $this->renderView('MRSControleBundle:Default:index.html.twig', array(
            'name'  => $name
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="MyFile.pdf"'
            )
        );


    }

    /**
     * @Route("imageroute",name="image_route")
     */
    public function generateImageAction()
    {
        $name = 'Márcio';

        $html = $this->renderView('MRSControleBundle:Default:index.html.twig', array(
            'name'  => $name
        ));

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'image/jpg',
                'Content-Disposition'   => 'filename="MyImage.jpg"'
            )
        );


    }

    /**
     * @Route("/about", name="app_about")
     *
     */
    public function aboutAction()
    {

        return $this->render('::about.html.twig');

    }

}
