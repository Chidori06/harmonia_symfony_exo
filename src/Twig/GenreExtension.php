<?php

namespace App\Twig;

use App\Repository\GenreRepository;
use Twig\Attribute\AsTwigFilter;
use Twig\Attribute\AsTwigFunction;

final class GenreExtension
{


    public function __construct(
        private GenreRepository $genreRepository
    ) {

    }

    #[AsTwigFunction('getGenres')]
    public function getGenres(): array
    {
        return $this->genreRepository->findBy([], ['label' => 'ASC']);

    }
}
