<?php

namespace App\Repository;

use App\Entity\CustomerCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerCategory[]    findAll()
 * @method CustomerCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerCategory::class);
    }

    // /**
    //  * @return CustomerCategory[] Returns an array of CustomerCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerCategory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
