<?php

namespace App\Repository;

use App\Entity\SpaceshipSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpaceshipSection>
 *
 * @method SpaceshipSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceshipSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceshipSection[]    findAll()
 * @method SpaceshipSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceshipSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceshipSection::class);
    }

//    /**
//     * @return SpaceshipSection[] Returns an array of SpaceshipSection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SpaceshipSection
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
