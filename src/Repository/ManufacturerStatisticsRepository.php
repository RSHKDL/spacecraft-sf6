<?php

namespace App\Repository;

use App\Entity\ManufacturerStatistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ManufacturerStatistics>
 *
 * @method ManufacturerStatistics|null find($id, $lockMode = null, $lockVersion = null)
 * @method ManufacturerStatistics|null findOneBy(array $criteria, array $orderBy = null)
 * @method ManufacturerStatistics[]    findAll()
 * @method ManufacturerStatistics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerStatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ManufacturerStatistics::class);
    }
}
