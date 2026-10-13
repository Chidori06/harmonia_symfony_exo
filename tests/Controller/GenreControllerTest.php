<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GenreControllerTest extends WebTestCase
{
    public function testGenres(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/genre');

        $this->assertResponseIsSuccessful();
    }

    public function testGenreId(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/genre/255');

        $this->assertResponseIsSuccessful();
    }
}
