<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    //Redirection aussi
    public function testProfile(): void
    {
        $client = static::createClient();
        $user = static::getContainer()
            ->get(UserRepository::class)
            ->findOneBy(['email' => 'email@email.com']);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/profile');

        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('h1', 'Najim63');
    }

    public function testProfileKO(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/profile');

        $this->assertResponseRedirects('/login');
    }

}
