<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Entity\Track;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FavoriteController extends AbstractController
{
    #[Route('/add-favorite/{id}', name: 'app_favorite_toggle')]
    public function toggleFavorite(Track $track, FavoriteRepository $favoriteRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $favorite = $favoriteRepository->findOneByUserAndTrack($user, $track);

        if ($favorite) {
            $entityManager->remove($favorite);
        } else {
            $favorite = new Favorite();

            $favorite->setUser($user);
            $favorite->setTracks($track);
            $favorite->setLikedAt(new \DateTimeImmutable());

            $entityManager->persist($favorite);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_track', [
            'id' => $track->getId()
        ]);
    }

}
