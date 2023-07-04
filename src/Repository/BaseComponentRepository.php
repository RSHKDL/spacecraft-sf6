<?php

namespace App\Repository;

use App\Entity\BaseComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BaseComponent>
 *
 * @method BaseComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseComponent[]    findAll()
 * @method BaseComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaseComponent::class);
    }

    /**
     * Find a subset of options by their discriminator
     *
     * @see https://github.com/doctrine/orm/issues/4462
     */
    public function findByClass(string $class)
    {
        $qb = $this->createQueryBuilder('base_option');
        $qb->where('base_option INSTANCE OF :class_metadata');
        $qb->setParameter('class_metadata', $this->_em->getClassMetadata($class));

        return $qb->getQuery()->getResult();
    }

    public function findAllPaginated(int $currentPage = 1, int $limit = 25): Paginator
    {
        $qb = $this->createQueryBuilder('base_option');

        return $this->paginate($qb, $currentPage, $limit);
    }

    private function paginate(QueryBuilder $queryBuilder, int $page, int $limit): Paginator
    {
        $paginator = new Paginator($queryBuilder);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }
}
