<?php

namespace App\Repository;

use App\Entity\AMOAEQUIPE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AMOAEQUIPE>
 *
 * @method AMOAEQUIPE|null find($id, $lockMode = null, $lockVersion = null)
 * @method AMOAEQUIPE|null findOneBy(array $criteria, array $orderBy = null)
 * @method AMOAEQUIPE[]    findAll()
 * @method AMOAEQUIPE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AMOAEQUIPERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AMOAEQUIPE::class);
    }

    public function save(AMOAEQUIPE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AMOAEQUIPE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AMOAEQUIPE[] Returns an array of AMOAEQUIPE objects
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

//    public function findOneBySomeField($value): ?AMOAEQUIPE
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
