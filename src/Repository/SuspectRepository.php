<?php

namespace App\Repository;

use App\Entity\Suspect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Suspect|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suspect|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suspect[]    findAll()
 * @method Suspect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuspectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Suspect::class);
    }

    // /**
    //  * @return Suspect[] Returns an array of Suspect objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Suspect
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
