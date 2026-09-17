<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Track;
use App\Form\TrackType;
use App\Repository\FavoriteRepository;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function item($id, TrackRepository $trackRepository, FavoriteRepository $favoriteRepository): Response
    {
        $track = $trackRepository->find($id);
        if ($track === null) {
            return $this->redirectToRoute('app_home');
        }
        $favoriteTrackIds = [];

        if ($this->getUser()) {
            $favoriteTrackIds = $favoriteRepository->findTrackIdsByUser(
                $this->getUser()
            );
        }


        return $this->render('track/item.html.twig', [
            'track' => $track,
            'favoriteTrackIds' => $favoriteTrackIds,
        ]);
    }

    #[Route('/add-track/{id}', name: 'app_track_add')]
    public function addTrack(Album $album, Request $request, EntityManagerInterface $entityManager): Response
    {
        $track = new Track();

        $form = $this->createForm(TrackType::class, $track);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $track->setAlbum($album);
            $track->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($track);
            $entityManager->flush();

            return $this->redirectToRoute('app_album_item', [
                'id' => $album->getId()
            ]);
        }

        return $this->render('track/add.html.twig', [
            'trackForm' => $form->createView(),
            'album' => $album,
        ]);
    }
}
