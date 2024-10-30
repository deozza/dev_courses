<?php

namespace App\Repository;

use App\Entity\Hand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hand>
 *
 * @method Hand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hand[]    findAll()
 * @method Hand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hand::class);
    }

    public function save(Hand $hand, $persist = true): void
    {
        if ($persist) {
            $this->getEntityManager()->persist($hand);
        }
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return Hand[] Returns an array of Hand objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Hand
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
