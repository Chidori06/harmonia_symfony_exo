<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        //Créer la simulation du navigateur HTTP
        $client = static::createClient();
        //Crawler : page du DOM
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Retrouvez toutes nos musiques');
    }
}
