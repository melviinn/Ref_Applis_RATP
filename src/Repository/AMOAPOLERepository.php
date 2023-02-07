<?php

namespace App\Repository;

use App\Entity\AMOAPOLE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AMOAPOLE>
 *
 * @method AMOAPOLE|null find($id, $lockMode = null, $lockVersion = null)
 * @method AMOAPOLE|null findOneBy(array $criteria, array $orderBy = null)
 * @method AMOAPOLE[]    findAll()
 * @method AMOAPOLE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AMOAPOLERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AMOAPOLE::class);
    }

    public function save(AMOAPOLE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AMOAPOLE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AMOAPOLE[] Returns an array of AMOAPOLE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AMOAPOLE
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
