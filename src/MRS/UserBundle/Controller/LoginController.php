<?php

namespace MRS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LoginController extends Controller
{

    /**
     * @Route("/login", name="user_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        //return new Response('OK!');

/*        $request = $this->getRequest();

        $session = $request->getSession();

        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

        $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        );*/


        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
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
