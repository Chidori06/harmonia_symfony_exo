<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ArtistRepository $artistRepository): Response
    {

        $artists = $artistRepository->findAll();
        return $this->render('artist/index.html.twig', [
            'artists' => $artists
        ]);
    }

    #[Route('/artist-add', name: 'app_artist_add')]
    public function addArtist(EntityManagerInterface $em, Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artist->setCreatedAt(new \DateTimeImmutable());
            $em->persist($artist);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('artist/add.html.twig', [
            'artistForm' => $form->createView()
        ]);
    }

    #[Route('/artist-edit/{id}', name: 'app_artist_edit')]
    public function editArtist(Artist $artist, EntityManagerInterface $em, Request $request): Response
    {

        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('artist/edit.html.twig', [
            'artistForm' => $form->createView()
        ]);
    }
}
