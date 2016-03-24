<?php

namespace MRS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    /**
     * @Route("/login", name="user_login")
     * @Template()
     */
    public function loginAction()
    {
        //return new Response('OK!');

        $request = $this->getRequest();

        $session = $request->getSession();

        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

        $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     * @Template()
     */
    public function loginCheckAction()
    {
        //return new Response('Login Check');
    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function logoutAction()
    {

    }
}
