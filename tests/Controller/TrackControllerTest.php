<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackControllerTest extends WebTestCase
{
    public function testTrack(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/track');

        $this->assertResponseIsSuccessful();
    }

    public function testTrackId(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/track/1605');

        $this->assertResponseIsSuccessful();
    }

    public function testTrackAdd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'add-track/2180');

        $this->assertResponseIsSuccessful();
    }

    public function testTrackEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/edit-track/1666');

        $this->assertResponseIsSuccessful();
    }
}
