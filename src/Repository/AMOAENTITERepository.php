<?php

namespace App\Repository;

use App\Entity\AMOAENTITE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AMOAENTITE>
 *
 * @method AMOAENTITE|null find($id, $lockMode = null, $lockVersion = null)
 * @method AMOAENTITE|null findOneBy(array $criteria, array $orderBy = null)
 * @method AMOAENTITE[]    findAll()
 * @method AMOAENTITE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AMOAENTITERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AMOAENTITE::class);
    }

    public function save(AMOAENTITE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AMOAENTITE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AMOAENTITE[] Returns an array of AMOAENTITE objects
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

//    public function findOneBySomeField($value): ?AMOAENTITE
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
