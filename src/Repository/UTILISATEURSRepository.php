<?php

namespace App\Repository;

use App\Entity\UTILISATEURS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UTILISATEURS>
 *
 * @method UTILISATEURS|null find($id, $lockMode = null, $lockVersion = null)
 * @method UTILISATEURS|null findOneBy(array $criteria, array $orderBy = null)
 * @method UTILISATEURS[]    findAll()
 * @method UTILISATEURS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UTILISATEURSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UTILISATEURS::class);
    }

    public function save(UTILISATEURS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UTILISATEURS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Récupérer les données de tout les utilisateurs - SQL -> (app_list_utilisateurs_json)
    public function findAllUtilisateursToArray() {
        return $this->createQueryBuilder('user')
            ->select('user.MATRICULE as user_matricule, user.NOM as user_nom, user.PRENOM as user_prenom')
            ->leftJoin('user.ID_PROFIL', 'profil', 'WITH', 'user.ID_PROFIL = profil.id')
            ->addSelect('profil.LIB_PROFIL as profil_lib')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // Récupérer les données de tout les utilisateurs pour export Excel (app_liste_utilisateurs_xlsx)
    public function findAllUtilisateursToExport() {
        return $this->createQueryBuilder('user')
            ->select('user.MATRICULE as user_matricule, user.NOM as user_nom, user.PRENOM as user_prenom')
            ->leftJoin('user.ID_PROFIL', 'profil', 'WITH', 'user.ID_PROFIL = profil.id')
            ->addSelect('profil.LIB_PROFIL as profil_lib')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // Récupérer un utilisateur en fonction de son id 
    public function findUtilisateursById($id) {
        return $this->createQueryBuilder('user')
            ->select('user')
            ->where('user.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return UTILISATEURS[] Returns an array of UTILISATEURS objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UTILISATEURS
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
