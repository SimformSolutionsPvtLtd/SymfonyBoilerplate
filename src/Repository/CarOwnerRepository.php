<?php

namespace App\Repository;

use App\Entity\CarOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarOwner>
 *
 * @method CarOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarOwner[]    findAll()
 * @method CarOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarOwner::class);
    }

    public function save(CarOwner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarOwner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
