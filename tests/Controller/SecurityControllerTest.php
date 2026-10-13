<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }

    public function testLogout(): void
    {
        $client = static::createClient();
        $user = static::getContainer()
            ->get(UserRepository::class)
            ->findOneBy(['email' => 'email@email.com']);

        $client->loginUser($user);

        $crawler = $client->request('GET', '/logout');

        $this->assertResponseRedirects('/');
    }

}
