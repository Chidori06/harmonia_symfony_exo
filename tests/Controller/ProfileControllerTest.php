<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    //Redirection aussi
    public function testProfile(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/profile');

        $this->assertResponseStatusCodeSame(302);
    }

}
