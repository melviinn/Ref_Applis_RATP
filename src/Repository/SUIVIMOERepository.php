<?php

namespace App\Repository;

use App\Entity\SUIVIMOE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SUIVIMOE>
 *
 * @method SUIVIMOE|null find($id, $lockMode = null, $lockVersion = null)
 * @method SUIVIMOE|null findOneBy(array $criteria, array $orderBy = null)
 * @method SUIVIMOE[]    findAll()
 * @method SUIVIMOE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SUIVIMOERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SUIVIMOE::class);
    }

    public function save(SUIVIMOE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SUIVIMOE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Récupérer les données d'un suivi en fonction de son id 
    public function findSuiviById($id) {
        return $this->createQueryBuilder('suivi')
            ->select('suivi')
            ->where('suivi.ID_APPLICATION = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    /**
//     * @return SUIVIMOE[] Returns an array of SUIVIMOE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SUIVIMOE
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
