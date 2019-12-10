<?php

namespace App\Repository;

use App\Entity\PassRecovery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PassRecovery|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassRecovery|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassRecovery[]    findAll()
 * @method PassRecovery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassRecoveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassRecovery::class);
    }

    // /**
    //  * @return PassRecovery[] Returns an array of PassRecovery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PassRecovery
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
