<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TestSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestSession>
 *
 * @method TestSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestSession[]    findAll()
 * @method TestSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class TestSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestSession::class);
    }

    public function save(TestSession $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TestSession $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
