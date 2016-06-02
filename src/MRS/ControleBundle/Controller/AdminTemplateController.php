<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminTemplateController extends Controller
{

    /**
     * @Route("/admintemplate", name="admintemplate")
     */
    public function indexAction()
    {

        $name = 'Marcio';

        return $this->render('MRSControleBundle:AdminTemplate:index.html.twig',
            [ 'name' => $name]
        );
    }



}
