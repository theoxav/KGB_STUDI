<?php

namespace App\Repository;

use App\Entity\MissionGender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MissionGender|null find($id, $lockMode = null, $lockVersion = null)
 * @method MissionGender|null findOneBy(array $criteria, array $orderBy = null)
 * @method MissionGender[]    findAll()
 * @method MissionGender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionGenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MissionGender::class);
    }

    // /**
    //  * @return MissionGender[] Returns an array of MissionGender objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MissionGender
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
