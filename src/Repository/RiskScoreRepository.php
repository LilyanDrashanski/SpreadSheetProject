<?php

namespace App\Repository;

use App\Entity\RiskScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RiskScore>
 */
class RiskScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RiskScore::class);
    }

    public function findById(int $id): ?RiskScore
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return RiskScore[] Returns an array of RiskScore objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
//
//        public function findOneBySomeField($value): ?RiskScore
//        {
//            return $this->createQueryBuilder('r')
//                ->andWhere('r.exampleField = :val')
//                ->setParameter('val', $value)
//                ->getQuery()
//                ->getOneOrNullResult()
//            ;
//        }
}
