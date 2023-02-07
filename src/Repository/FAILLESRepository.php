<?php

namespace App\Repository;

use App\Entity\FAILLES;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FAILLES>
 *
 * @method FAILLES|null find($id, $lockMode = null, $lockVersion = null)
 * @method FAILLES|null findOneBy(array $criteria, array $orderBy = null)
 * @method FAILLES[]    findAll()
 * @method FAILLES[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FAILLESRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FAILLES::class);
    }

    public function save(FAILLES $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FAILLES $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Récupérer les données de toutes les failles - SQL -> (app_list_failles_json)
    public function findAllFaillesSQLToArray() {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT failles_id, COUNT(applications_id) as nbApps, lib_faille as failles_lib, comp_faille as failles_comp,
            date_faille as failles_date, statut as failles_statut, date_fermeture as failles_date_fermeture
            FROM failles_applications
            LEFT JOIN failles ON failles_applications.failles_id = failles.id
            GROUP BY failles_id
        ';
        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    // Récupérer les données de toutes les failles pour export Excel (app_list_failles_xlsx)
    public function findAllFaillesSQLToExport() {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT lib_faille as failles_lib, comp_faille as failles_comp, date_faille as failles_date, 
            COUNT(applications_id) as nbApps, statut as failles_statut, date_fermeture as failles_date_fermeture
            FROM failles_applications
            LEFT JOIN failles ON failles_applications.failles_id = failles.id
            GROUP BY failles_id
        ';
        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    // Récupération des détails pour chaque faille -> (app_details_failles)
    public function findDetailsFaillesSQLById($id) {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT app.application, moa.code_moa, moa.lib_moa, failles.statut
            FROM failles_applications
            LEFT JOIN failles ON failles_applications.failles_id = failles.id
            LEFT JOIN applications as app ON failles_applications.applications_id = app.id
            LEFT JOIN moa ON app.id_moa_id = moa.id
            WHERE failles.id = :id
            GROUP BY app.application
        ';
        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $id]);

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return FAILLES[] Returns an array of FAILLES objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FAILLES
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
