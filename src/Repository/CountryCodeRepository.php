<?php

namespace App\Repository;

use App\Entity\CountryCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CountryCode>
 *
 * @method CountryCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountryCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountryCode[]    findAll()
 * @method CountryCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryCode::class);
    }

    public function save(CountryCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CountryCode $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAll()
    {
        return $this->createQueryBuilder('cc')
                ->select('cc')
                ->orderBy('cc.code', "ASC");
    }
}
