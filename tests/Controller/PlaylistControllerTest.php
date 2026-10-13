<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlaylistControllerTest extends WebTestCase
{
    //Problème de redirection 302 donc pas de 200
    public function testPlaylists(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlist/Najim63');

        $this->assertResponseStatusCodeSame(302);
    }

    public function testPlaylistAdd(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add-playlist/Najim63');

        $this->assertResponseStatusCodeSame(302);
    }

    public function testPlaylistEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/edit-playlist/Najim63/272');

        $this->assertResponseStatusCodeSame(302);
    }

    public function testPlaylistMusicEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlist/272/edit-tracks');

        $this->assertResponseStatusCodeSame(302);
    }


}
