<?php

namespace App\Repository;

use App\Entity\Blueprint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blueprint>
 *
 * @method Blueprint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blueprint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blueprint[]    findAll()
 * @method Blueprint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlueprintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blueprint::class);
    }

    public function add(Blueprint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Blueprint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
