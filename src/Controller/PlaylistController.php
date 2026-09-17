<?php

namespace App\Controller;

use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist/{user}', name: 'app_playlist')]
    public function index($user, PlaylistRepository $playlistRepository): Response
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }
        $playlist = $playlistRepository->findBy(['user' => $user]);

        return $this->render('playlist/index.html.twig', [
            'playlist' => $playlist,
            'user' => $user
        ]);
    }
}
