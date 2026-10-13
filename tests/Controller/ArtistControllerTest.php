<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtistControllerTest extends WebTestCase
{
    public function testArtist(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/artist');

        $this->assertResponseIsSuccessful();
    }

    public function testArtistId(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/artist/2452');

        $this->assertResponseIsSuccessful();
    }

    public function testArtistAdd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/artist-add');

        $this->assertResponseIsSuccessful();
    }

    public function testArtistEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/artist-edit/2452');

        $this->assertResponseIsSuccessful();
    }
}
