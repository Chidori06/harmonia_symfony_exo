<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Form\PlaylistTrackType;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/add-playlist/{user}', name: 'app_playlist_add')]
    public function addPlaylist($user, EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }

        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playlist->setCreatedAt(new \DateTimeImmutable());
            $playlist->setUser($user);
            $em->persist($playlist);
            $em->flush();

            return $this->redirectToRoute('app_playlist_tracks', [
                'id' => $playlist->getId()
            ]);
        }

        return $this->render('playlist/add.html.twig', [
            'user' => $user,
            'playlistForm' => $form->createView()
        ]);
    }

    #[Route('/edit-playlist/{user}/{id}', name: 'app_playlist_edit')]
    public function editPlaylist($user, Playlist $playlist, EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_playlist', [
                'user' => $user->getPseudonym(),
            ]);
        }

        return $this->render('playlist/add.html.twig', [
            'user' => $user,
            'playlistForm' => $form->createView()
        ]);
    }

    #[Route('/playlist/{id}/add-tracks', name: 'app_playlist_tracks')]
    public function addTracks(Playlist $playlist, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(PlaylistTrackType::class, $playlist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist', [
                'user' => $user->getPseudonym(),

            ]);
        }

        return $this->render('playlist/addTrack.html.twig', [
            'playlist' => $playlist,
            'tracksForm' => $form,
            'user' => $user
        ]);
    }

    #[Route('/playlist/{id}/edit-tracks', name: 'app_playlist_edit_track')]
    public function editTracks(Playlist $playlist, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }
        $form = $this->createForm(PlaylistTrackType::class, $playlist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist', [
                'user' => $user->getPseudonym(),
            ]);
        }

        return $this->render('playlist/editTrack.html.twig', [
            'playlist' => $playlist,
            'tracksForm' => $form->createView(),
            'user' => $user,
        ]);
    }


}
