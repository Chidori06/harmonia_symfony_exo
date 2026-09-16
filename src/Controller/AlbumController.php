<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlbumController extends AbstractController
{
    #[Route('/album/{id}', name: 'app_album_item')]
    public function item($id, AlbumRepository $albumRepository): Response
    {
        $album = $albumRepository->find($id);
        if ($album === null) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('album/item.html.twig', [
            'album' => $album

        ]);
    }
}
