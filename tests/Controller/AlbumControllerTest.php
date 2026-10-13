<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlbumControllerTest extends WebTestCase
{
    public function testAlbumId(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/album/2171');

        $this->assertResponseIsSuccessful();
    }

    public function testAlbumAdd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add-album/2452');

        $this->assertResponseIsSuccessful();
    }

    public function testAlbumEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/edit-album/2176');

        $this->assertResponseIsSuccessful();
    }
}
