<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GenreController extends AbstractController
{
    #[Route('/genre', name: 'app_genre')]
    public function index(GenreRepository $genreRepository): Response
    {
        $genres = $genreRepository->findAll();
        return $this->render('genre/index.html.twig', [
            'genres' => $genres
        ]);
    }

    #[Route('/genre/{id}', name: 'app_genre_item')]
    public function item($id, GenreRepository $genreRepository): Response
    {
        $genre = $genreRepository->find($id);
        if ($genre === null) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('genre/item.html.twig', [
            'genre' => $genre
        ]);
    }
}
