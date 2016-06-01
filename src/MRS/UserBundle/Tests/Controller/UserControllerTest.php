<?php

namespace MRS\ControleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testAccessToUriCode200()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $client->request('GET', '/about/user/1');
        $uri = $client->getRequest()->getUri();
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(200,
            $client->getResponse()->getStatusCode(),
            "Code: {$code} Unexpected HTTP status code for URI {$uri} GET");

    }


    public function testAccessToUriCode302()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $client->request('GET', '/admin/user/about/user/1');
        $uri = $client->getRequest()->getUri();
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(200,
            $client->getResponse()->getStatusCode(),
            "Code: {$code} Unexpected HTTP status code for URI {$uri} GET");

    }


    public function testAcessUriUser()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $client->request('GET', '/admin/user');
        $uri = $client->getRequest()->getUri();
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(301,
            $client->getResponse()->getStatusCode(),
            "Code: {$code} Unexpected HTTP status code for URI {$uri} GET");

    }

}
