<?php

namespace App\Repository;

use App\Entity\Spaceship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Spaceship>
 *
 * @method Spaceship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spaceship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spaceship[]    findAll()
 * @method Spaceship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spaceship::class);
    }

    public function add(Spaceship $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Spaceship $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
