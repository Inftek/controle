<?php

namespace MRS\ControleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard');

        $this->assertTrue($crawler->filter('html:contains("Dashboard")')->count() > 0);
    }
}
