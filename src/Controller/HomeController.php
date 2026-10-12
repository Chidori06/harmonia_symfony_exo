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

        $eps = $albumRepository->findWithRelations('ep', 8);
        $singles = $albumRepository->findWithRelations('single', 8);
        $albums = $albumRepository->findWithRelations('album', 8);

        $albumAfter = $albumRepository->getAlbumsAfter20s();
        $albumBefore = $albumRepository->getAlbumsBefore20s();

        return $this->render('home/index.html.twig', [
            'albums' => $albums,
            'eps' => $eps,
            'singles' => $singles,
            'albumAfter' => $albumAfter,
            'albumBefore' => $albumBefore
        ]);
    }
}
