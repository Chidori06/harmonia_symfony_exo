<?php

namespace App\Repository;

use App\Entity\Album;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Album>
 */
class AlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    //    /**
//     * @return Album[] Returns an array of Album objects
//     */

    public function getAlbumsAfter20s()
    {
        return $this->createQueryBuilder('a')
            ->where('a.releaseAt >= :date')
            ->setParameter('date', new \DateTime('2000-01-01 00:00:00'))
            ->getQuery()
            ->getResult();
    }

    public function getAlbumsBefore20s()
    {
        return $this->createQueryBuilder('a')
            ->where('a.releaseAt <= :date')
            ->setParameter('date', new \DateTime('2000-01-01 00:00:00'))
            ->getQuery()
            ->getResult();
    }


    //    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?Album
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
