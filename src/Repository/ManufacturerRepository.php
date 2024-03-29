<?php

namespace App\Repository;

use App\Entity\Manufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Manufacturer>
 *
 * @method Manufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manufacturer[]    findAll()
 * @method Manufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    public function add(Manufacturer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Manufacturer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Manufacturer[] Returns an array of Manufacturer objects
     */
    public function search(?string $term): array
    {
        $qb = $this->createQueryBuilder('m');

        if ($term) {
            $qb->andWhere($qb->expr()->like('m.name', ':term'));
            $qb->setParameter('term', "%$term%");
        }

        return $qb->getQuery()->getResult();
    }

    public function selectableManufacturersQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('m');
        $qb
            ->select('m')
            ->orderBy('m.name', 'ASC');

        return $qb;
    }
}
