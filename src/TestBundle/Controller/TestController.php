<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 26/03/16
 * Time: 19:04
 */

namespace TestBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class TestController extends Controller
{

    /**
     * @return Response
     * @Route("/testbundle", name="test_bundle")
     * @Template()
     */
    public function indexAction()
    {
        return array('dados' => 'Seu Bundle'.get_class($this) . ' está funcionando');
    }

}