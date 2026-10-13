<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FavoriteControllerTest extends WebTestCase
{
    public function testFavorite(): void
    {
        $client = static::createClient();
        $user = static::getContainer()
            ->get(UserRepository::class)
            ->findOneBy(['email' => 'email@email.com']);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/add-favorite/1609');

        $this->assertResponseIsSuccessful();
    }
}
