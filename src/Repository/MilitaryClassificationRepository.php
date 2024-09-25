<?php

namespace App\Repository;

use App\Entity\MilitaryClassification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MilitaryClassification>
 *
 * @method MilitaryClassification|null find($id, $lockMode = null, $lockVersion = null)
 * @method MilitaryClassification|null findOneBy(array $criteria, array $orderBy = null)
 * @method MilitaryClassification[]    findAll()
 * @method MilitaryClassification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MilitaryClassificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MilitaryClassification::class);
    }

    public function add(MilitaryClassification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MilitaryClassification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SpaceshipClass[] Returns an array of SpaceshipClass objects
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

//    public function findOneBySomeField($value): ?SpaceshipClass
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
