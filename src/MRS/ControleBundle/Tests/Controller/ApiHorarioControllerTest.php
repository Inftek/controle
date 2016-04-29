<?php

namespace MRS\ControleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiHorarioControllerTest extends WebTestCase
{
    public function testListhorario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listHorario');
    }

}
