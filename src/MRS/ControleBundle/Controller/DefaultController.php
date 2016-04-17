<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
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

        $attach = \Swift_Attachment::fromPath('/home/marcio/Imagens/fall.jpg');


        $Message = \Swift_Message::newInstance();

        $Message->attach($attach);

            $Message->setSubject('Hello Marcio')
                ->setFrom('marcio.santos@ceadis.org.br')
                ->setTo('vinicius.saraiva@ceadis.org.br')
                ->addTo('marcio.santos@ceadis.org.br')
                ->addTo('marciomrs4@hotmail.com')
                ->addTo('marciomrs4@gmail.com')
                ->setBody(
                    $this->renderView('MRSControleBundle:Default:Email.html.twig',
                                        array('name' => rand(1,1000))),
                    'text/html');


        $Email = $this->get('mailer')->send($Message);


        return new Response('Lindo Funcionando '. $Message);
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

}
