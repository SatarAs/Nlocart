<?php

namespace App\Repository;

use App\Entity\TechArtwork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TechArtwork|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechArtwork|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechArtwork[]    findAll()
 * @method TechArtwork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechArtworkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TechArtwork::class);
    }



    public function findTechByArtwork($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.artwork = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return TechArtwork[] Returns an array of TechArtwork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TechArtwork
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
