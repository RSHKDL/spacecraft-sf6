<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function add(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOrdersAvailableForTracking(): array
    {
        $qb = $this->createQueryBuilder('o')
            ->leftJoin('o.status', 's_delivered', 'WITH', 's_delivered.code = :delivered')
            ->leftJoin('o.status', 's_paid', 'WITH', 's_paid.code = :paid')
            ->leftJoin('o.status', 's_shipped', 'WITH', 's_shipped.code = :shipped')
            ->andWhere('s_delivered.code IS NULL') // Orders not yet delivered
            ->andWhere('(s_paid.code = :paid OR s_shipped.code = :shipped)') // Either paid or shipped
            ->setParameters([
                'delivered' => 'delivered',
                'paid' => 'paid',
                'shipped' => 'shipped',
            ]);

        return $qb->getQuery()->getResult();
    }
}
