<?php

namespace App\Repository;

use App\Entity\Coupable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Coupable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupable[]    findAll()
 * @method Coupable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoupableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupable::class);
    }

    // /**
    //  * @return Coupable[] Returns an array of Coupable objects
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
    public function findOneBySomeField($value): ?Coupable
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
