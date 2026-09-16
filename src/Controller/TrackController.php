<?php

namespace App\Controller;

use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrackController extends AbstractController
{
    #[Route('/track', name: 'app_track')]
    public function index(TrackRepository $trackRepository): Response
    {

        $tracks = $trackRepository->findAll();
        return $this->render('track/index.html.twig', [
            'tracks' => $tracks,
        ]);
    }

    #[Route('/track/{id}', name: 'app_track_item')]
    public function item($id, TrackRepository $trackRepository): Response
    {
        $track = $trackRepository->find($id);
        if ($track === null) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('track/item.html.twig', [
            'track' => $track
        ]);
    }
}
