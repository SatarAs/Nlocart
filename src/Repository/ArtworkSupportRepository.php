<?php

namespace App\Repository;

use App\Entity\ArtworkSupport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtworkSupport|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtworkSupport|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtworkSupport[]    findAll()
 * @method ArtworkSupport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtworkSupportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtworkSupport::class);
    }

    // /**
    //  * @return ArtworkSupport[] Returns an array of ArtworkSupport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArtworkSupport
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
