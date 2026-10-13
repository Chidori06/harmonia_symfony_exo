<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlaylistControllerTest extends WebTestCase
{
    public function testPlaylists(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlist/Najim63');

        $this->assertResponseIsSuccessful();
    }

    public function testPlaylistAdd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add-playlist/Najim63');

        $this->assertResponseIsSuccessful();
    }

    public function testPlaylistEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/edit-playlist/Najim63/272');

        $this->assertResponseIsSuccessful();
    }

    public function testPlaylistMusicEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlist/272/edit-tracks');

        $this->assertResponseIsSuccessful();
    }


}
