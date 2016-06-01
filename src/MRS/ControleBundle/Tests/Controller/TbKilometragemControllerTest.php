<?php

namespace MRS\ControleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TbKilometragemControllerTest extends WebTestCase
{

    public function testRequestBaseUri()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $client->request('GET', '/kilometragem');
        $uri = $client->getRequest()->getUri();
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $code, "Code: {$code} Unexpected HTTP status code for {$uri} GET");

    }


    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/controle/dashboard');
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Code: {$code} Unexpected HTTP status code for GET");
        $crawler = $client->click($crawler->selectLink('Novo')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'mrs_controlebundle_tbkilometragem[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'mrs_controlebundle_tbkilometragem[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
*/

}
