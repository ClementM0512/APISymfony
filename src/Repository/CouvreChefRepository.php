<?php

namespace App\Repository;

use App\Entity\CouvreChef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CouvreChef|null find($id, $lockMode = null, $lockVersion = null)
 * @method CouvreChef|null findOneBy(array $criteria, array $orderBy = null)
 * @method CouvreChef[]    findAll()
 * @method CouvreChef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouvreChefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CouvreChef::class);
    }

    // /**
    //  * @return CouvreChef[] Returns an array of CouvreChef objects
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
    public function findOneBySomeField($value): ?CouvreChef
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
