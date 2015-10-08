<?php

namespace MRS\ControleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SerializerControllerControllerTest extends WebTestCase
{
    public function testFinancas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'jsonfinancas');
    }

}
