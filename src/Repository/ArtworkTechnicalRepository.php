<?php

namespace App\Repository;

use App\Entity\ArtworkTechnical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArtworkTechnical|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtworkTechnical|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtworkTechnical[]    findAll()
 * @method ArtworkTechnical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtworkTechnicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtworkTechnical::class);
    }

    // /**
    //  * @return ArtworkTechnical[] Returns an array of ArtworkTechnical objects
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
    public function findOneBySomeField($value): ?ArtworkTechnical
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
