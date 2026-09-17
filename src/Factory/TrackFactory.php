<?php

namespace App\Factory;

use App\Entity\Track;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentObjectFactory<Track>
 */
final class TrackFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Track::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {

        $minutes = self::faker()->numberBetween(2, 6);
        $seconds = self::faker()->numberBetween(0, 59);
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'duration' => ($minutes * 60) + $seconds,
            'isExplicit' => self::faker()->boolean(),
            'numberTrack' => self::faker()->numberBetween(1, 20),
            'playCount' => self::faker()->randomNumber(),
            'title' => self::faker()->words(2, true),
            'album' => AlbumFactory::random(),
            'playlists' => PlaylistFactory::randomRange(2, 6),
            'genres' => GenreFactory::randomRange(1, 3),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Track $track): void {})
        ;
    }
}
