<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use App\Factory\AlbumFactory;
use App\Factory\ArtistFactory;
use App\Factory\FavoriteFactory;
use App\Factory\GenreFactory;
use App\Factory\ListenHistoryFactory;
use App\Factory\PlaylistFactory;
use App\Factory\TrackFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $genres = ["Rock", "Jazz", "Pop", "Metal", "Hip-hop", "Électro", "RnB", "Classique"];
        foreach ($genres as $value) {
            GenreFactory::createOne([
                'label' => $value
            ]);
        }
        ArtistFactory::createMany(50);
        UserFactory::createMany(50);
        AlbumFactory::createMany(50);
        PlaylistFactory::createMany(15);
        TrackFactory::createMany(100);
        ListenHistoryFactory::createMany(50);
        FavoriteFactory::createMany(50);


        $manager->flush();
    }
}
