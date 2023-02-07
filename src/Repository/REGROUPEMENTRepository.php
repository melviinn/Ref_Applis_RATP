<?php

namespace App\Repository;

use App\Entity\REGROUPEMENT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<REGROUPEMENT>
 *
 * @method REGROUPEMENT|null find($id, $lockMode = null, $lockVersion = null)
 * @method REGROUPEMENT|null findOneBy(array $criteria, array $orderBy = null)
 * @method REGROUPEMENT[]    findAll()
 * @method REGROUPEMENT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class REGROUPEMENTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, REGROUPEMENT::class);
    }

    public function save(REGROUPEMENT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(REGROUPEMENT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return REGROUPEMENT[] Returns an array of REGROUPEMENT objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?REGROUPEMENT
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
