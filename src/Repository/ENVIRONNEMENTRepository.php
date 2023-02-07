<?php

namespace App\Repository;

use App\Entity\ENVIRONNEMENT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ENVIRONNEMENT>
 *
 * @method ENVIRONNEMENT|null find($id, $lockMode = null, $lockVersion = null)
 * @method ENVIRONNEMENT|null findOneBy(array $criteria, array $orderBy = null)
 * @method ENVIRONNEMENT[]    findAll()
 * @method ENVIRONNEMENT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ENVIRONNEMENTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ENVIRONNEMENT::class);
    }

    public function save(ENVIRONNEMENT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ENVIRONNEMENT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Récupérer un environnement en fonction de son id 
    public function findEnvById($id) {
        return $this->createQueryBuilder('env')
            //->leftJoin('env.BRIQUES', 'brq', 'WITH', 'env.ID_APPLICATION = :id')
            ->select('env')
            ->where('env.ID_APPLICATION = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    /**
//     * @return ENVIRONNEMENT[] Returns an array of ENVIRONNEMENT objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ENVIRONNEMENT
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
