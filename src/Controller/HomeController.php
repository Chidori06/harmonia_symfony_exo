<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AlbumRepository $albumRepository): Response
    {

        // $albums = $albumRepository->findAll();
        $eps = $albumRepository->findBy(['type' => 'EP']);
        $singles = $albumRepository->findBy(['type' => 'Single']);
        $albums = $albumRepository->findBy(['type' => 'Album']);
        $albumAfter = $albumRepository->getAlbumsAfter20s();
        $albumBefore = $albumRepository->getAlbumsBefore20s();

        //Soit entité user soit null
        // $user = $this->getUser();
        // dump($user);

        return $this->render('home/index.html.twig', [
            'albums' => $albums,
            'eps' => $eps,
            'singles' => $singles,
            'albumAfter' => $albumAfter,
            'albumBefore' => $albumBefore
        ]);
    }
}
