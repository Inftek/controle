<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/financas/');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('Control panel', $crawler->filter('#container h1')->text());
        $this->assertTrue($crawler->filter('html:contains("Dashboard")')->count() > 0);
    }
}
