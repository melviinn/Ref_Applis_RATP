<?php

namespace App\Repository;

use App\Entity\FAILLESAPPLICATIONS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FAILLESAPPLICATIONS>
 *
 * @method FAILLESAPPLICATIONS|null find($id, $lockMode = null, $lockVersion = null)
 * @method FAILLESAPPLICATIONS|null findOneBy(array $criteria, array $orderBy = null)
 * @method FAILLESAPPLICATIONS[]    findAll()
 * @method FAILLESAPPLICATIONS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FAILLESAPPLICATIONSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FAILLESAPPLICATIONS::class);
    }

    public function save(FAILLESAPPLICATIONS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FAILLESAPPLICATIONS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllFaillesApplicationsToArray() {
        return $this->createQueryBuilder('failles')
            ->select('app.id, fai.id')
            ->leftJoin('failles.ID_APPLICATION', 'app', 'WITH', 'failles.ID_APPLICATION = app.id')
            ->addSelect('app.APPLICATION')
            ->leftJoin('failles.ID_FAILLE', 'fai', 'WITH', 'failles.ID_FAILLE = fai.id')
            ->addSelect('fai.LIB_FAILLE')
            ->addSelect('failles.IMPACTE', 'failles.TRAITEMENT', 'failles.COMMENTAIRES')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function test() {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT app.application, fai.lib_faille, failles.impacte, failles.traitement
            FROM faillesapplications as failles
            LEFT JOIN applications as app ON app.id = failles.id_application_id
            LEFT JOIN failles as fai ON failles.id_faille_id = fai.id
            GROUP BY app.application
        ';

        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function findFaillesSQLById($id) {
        return $this->createQueryBuilder('faillesApps')
            ->select('GROUP_CONCAT(app.APPLICATION) as apps, faille.LIB_FAILLE, faille.COMP_FAILLE,
                    faille.DATE_FAILLE, faille.STATUT, faille.DATE_FERMETURE')
            ->leftJoin('faillesApps.ID_FAILLE', 'faille', 'WITH', 'faillesApps.ID_FAILLE = faille.id')
            ->leftJoin('faillesApps.ID_APPLICATION', 'app', 'WITH', 'faillesApps.ID_APPLICATION = app.id')
            ->where('faille.id = :id')
            ->groupBy('faille.id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function testById($id) {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT GROUP_CONCAT(app.APPLICATION SEPARATOR ", ") as ID_APPLICATION, fai.lib_faille as LIB_FAILLE, fai.comp_faille as COMP_FAILLE, 
            fai.date_faille as DATE_FAILLE, fai.statut as STATUT, fai.date_fermeture as DATE_FERMETURE
            FROM faillesapplications as failles
            LEFT JOIN applications as app ON app.id = failles.id_application_id
            LEFT JOIN failles as fai ON failles.id_faille_id = fai.id
            WHERE fai.id = :id
            GROUP BY fai.id
        ';

        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $id]);

        return $resultSet->fetchAllAssociative();
    }

    public function findTest($id) {
        return $this->createQueryBuilder('faillesApps')
            ->select('faillesApps')
            ->leftJoin('faillesApps.ID_FAILLE', 'faille', 'WITH', 'faillesApps.ID_FAILLE = faille.id')
            ->leftJoin('faillesApps.ID_APPLICATION', 'app', 'WITH', 'faillesApps.ID_APPLICATION = app.id')
            ->where('faille.id = :id')
            ->groupBy('faillesApps.ID_FAILLE')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    /**
//     * @return FAILLESAPPLICATIONS[] Returns an array of FAILLESAPPLICATIONS objects
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

//    public function findOneBySomeField($value): ?FAILLESAPPLICATIONS
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
