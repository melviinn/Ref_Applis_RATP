<?php

namespace App\Repository;

use App\Entity\APPLICATIONS;
use App\Entity\BRIQUES;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<APPLICATIONS>
 *
 * @method APPLICATIONS|null find($id, $lockMode = null, $lockVersion = null)
 * @method APPLICATIONS|null findOneBy(array $criteria, array $orderBy = null)
 * @method APPLICATIONS[]    findAll()
 * @method APPLICATIONS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class APPLICATIONSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, APPLICATIONS::class);
    }

    public function save(APPLICATIONS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(APPLICATIONS $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Récupérer toutes les données des applications - SQL (fonction GROUP_CONCAT() -> bon affichage des briques applicatives) (app_liste_apps_json)
    public function findAllAppsSQLToArray() {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT app.application as libApp, moa.code_moa as codeMoa, user.matricule as userMatricule, pole.code_pole as codePoleAmoa,
            eq.code_equipe as codeEquipeAmoa, ent.code_entite as codeEntiteAmoa, moe.code_moe as codeMoe, moeext.lib_moe_ext as libMoeExt,
            moeint.code_eq_moe as codeEqMoe, moeint.code_unite_moe as codeUniteMoe, sta.lib_statut as libStatut, reg.lib_reg as libReg, 
            app.commentaires as commentairesApp, env.nom_serveur as nomServeur, env.type_appli as typeAppli, sit.code_site as libSite,
            env.type_acces as typeAcces, env.dev_locaux as devLocaux, env.qualifie as qualifieSit, 
            GROUP_CONCAT(brq.lib_brique SEPARATOR ", ") as libBrique, env.impact_mv_os as impactOS, env.impact_reorg as impactReorg, 
            env.impact_o365 as impactO365, env.impact_projet as impactProjet, env.flux_in as fluxIn, env.flux_out as fluxOut, cyb.lib_cyber as numCyber, env.date_reforme as dateReforme,
            env.date_fin_sup as dateFinSup, suivi.obsolescence as obsolescence, suivi.mv as mv, suivi.portage as portage, suivi.raison_portage as raisonPortage,
            suivi.statut_suivi as statutSuivi, suivi.date_debut as dateDebutSuivi, suivi.date_fin as dateFinSuivi, suivi.commentaires as commentairesSuivi
            FROM applications as app
            LEFT JOIN moa as moa ON app.id_moa_id = moa.id
            LEFT JOIN utilisateurs as user ON app.contact_id = user.id
            LEFT JOIN amoapole as pole ON app.id_pole_id = pole.id
            LEFT JOIN amoaequipe as eq ON app.id_equipe_id = eq.id
            LEFT JOIN amoaentite as ent ON app.id_entite_id = ent.id
            LEFT JOIN moe as moe ON app.id_moe_id = moe.id
            LEFT JOIN moeint as moeint ON app.id_moe_int_id = moeint.id
            LEFT JOIN moeext as moeext ON app.id_moe_ext_id = moeext.id
            LEFT JOIN statut as sta ON app.id_statut_id = sta.id
            LEFT JOIN environnement as env ON env.id_application_id = app.id
            LEFT JOIN environnement_briques as env_brq ON env_brq.environnement_id = env.id
            LEFT JOIN briques as brq ON env_brq.briques_id = brq.id
            LEFT JOIN site as sit ON env.id_site_id = sit.id
            LEFT JOIN regroupement as reg ON app.id_reg_id = reg.id
            LEFT JOIN cyber as cyb ON env.id_cyber_id = cyb.id
            LEFT JOIN suivimoe as suivi ON suivi.id_application_id = app.id
            GROUP BY app.id
        ';

        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    // Récupérer les informations fonctionnelles de chaque application - SQL (fonction GROUP_CONCAT() -> bon affichage des briques applicatives) (app_liste_apps_fonctionnelles_json)
    public function findAllAppsFonctionnellesToArray() {
        return $this->createQueryBuilder('app')
            ->select("app.id as appl_id, app.APPLICATION as appl_lib, app.DESCRIPTION as appl_desc, app.VERSION as appl_v,
                    app.FINALITE as appl_finalite, app.COMMENTAIRES as appl_commentaires")
            ->leftjoin("app.ID_MOA", "moa")
            ->addSelect("moa.CODE_MOA as moa_code")
            ->leftjoin("app.ID_POLE", "amoapole")
            ->addSelect("amoapole.CODE_POLE as amoa_codePole")
            ->leftjoin("app.ID_ENTITE", "amoaentite")
            ->addSelect("amoaentite.CODE_ENTITE as amoa_codeEntite")
            ->leftjoin("app.ID_EQUIPE", "amoaequipe")
            ->addSelect("amoaequipe.CODE_EQUIPE as amoa_codeEquipe")
            ->leftjoin("app.ID_MOE", "moe")
            ->addSelect("moe.CODE_MOE as moe_code")
            ->leftjoin("app.ID_MOE_EXT", "moeext")
            ->addSelect("moeext.LIB_MOE_EXT as moeext_lib")
            ->leftjoin("app.ID_MOE_INT", "moeint")
            ->addSelect("moeint.CODE_UNITE_MOE as moeint_codeUnite", "moeint.CODE_EQ_MOE as moeint_codeEquipe")
            ->leftjoin("app.ID_STATUT", "statut")
            ->addSelect("statut.LIB_STATUT as sta_lib")
            ->leftjoin("app.ID_REG", "regroupement")
            ->addSelect("regroupement.LIB_REG as reg_lib")
            ->leftJoin('app.CONTACT', 'user')
            ->addSelect('user.MATRICULE as user_matricule')
            ->leftJoin('app.ID_ADM', 'admin')
            ->addSelect('admin.MATRICULE as admin_matricule')
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // Récupérer les informations techniques de chaque application - SQL (fonction GROUP_CONCAT() -> bon affichage des briques applicatives) (app_liste_apps_techniques_json)
    public function findAllAppsTechniquesSQLToArray() {
        $connexionBD = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT app.application as app_lib, env.nom_serveur as env_nomServeur, env.type_appli as env_typeAppli,
            sit.code_site as site_code, env.dev_locaux as env_devLocaux, env.qualifie as env_qualifie,
            GROUP_CONCAT(brq.lib_brique SEPARATOR ", " ) as brq_lib, env.flux_in as env_fluxIn, env.flux_out as env_fluxOut, env.impact_mv_os as env_impactOs, env.impact_o365 as env_impactO365,
            env.impact_reorg as env_impactReorg, env.impact_projet as env_impactProjet, env.date_reforme as env_dateReforme,
            env.date_fin_sup as env_dateFinSup, suivi.obsolescence as suivi_obs, suivi.mv as suivi_mv, suivi.portage as suivi_portage,
            suivi.raison_portage as suivi_raisonPor, suivi.date_debut as suivi_dateDebut, suivi.date_fin as suivi_dateFin,
            suivi.commentaires as suivi_commentaires
            FROM applications as app
            LEFT JOIN environnement as env ON app.id = env.id_application_id
            LEFT JOIN site as sit ON env.id_site_id = sit.id
            LEFT JOIN environnement_briques as env_brq ON env_brq.environnement_id = env.id
            LEFT JOIN briques as brq ON env_brq.briques_id = brq.id
            LEFT JOIN suivimoe as suivi ON suivi.id_application_id = app.id
            GROUP BY app.id
        ';

        $stmt = $connexionBD->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    // Récupérer les données (fonctionnelles + techniques) des applications pour export Excel (app_liste_apps_xlsx)
    public function findAllAppsToExport() {
        return $this->createQueryBuilder('app')
            // Informations fonctionnelles
            ->select("app.APPLICATION as appl_lib")
            ->leftjoin("app.ID_MOA", "moa")
            ->addSelect("moa.CODE_MOA as moa_code")
            ->leftJoin('app.CONTACT', 'user')
            ->addSelect('user.MATRICULE as user_matricule')
            ->leftjoin("app.ID_POLE", "amoapole")
            ->addSelect("amoapole.CODE_POLE as amoa_codePole")
            ->leftjoin("app.ID_EQUIPE", "amoaequipe")
            ->addSelect("amoaequipe.CODE_EQUIPE as amoa_codeEquipe")
            ->leftjoin("app.ID_ENTITE", "amoaentite")
            ->addSelect("amoaentite.CODE_ENTITE as amoa_codeEntite")
            ->leftjoin("app.ID_MOE", "moe")
            ->addSelect("moe.CODE_MOE as moe_code")
            ->leftjoin("app.ID_MOE_EXT", "moeext")
            ->addSelect("moeext.LIB_MOE_EXT as moeext_lib")
            ->leftjoin("app.ID_MOE_INT", "moeint")
            ->addSelect("moeint.CODE_EQ_MOE as moeint_codeEquipe", "moeint.CODE_UNITE_MOE as moeint_codeUnite",)
            ->leftjoin("app.ID_STATUT", "statut")
            ->addSelect("statut.LIB_STATUT as sta_lib")
            ->leftJoin('app.ID_ADM', 'admin')
            ->addSelect('admin.MATRICULE as admin_matricule')
            ->leftjoin("app.ID_REG", "regroupement")
            ->addSelect("regroupement.LIB_REG as reg_lib")
            ->addSelect("app.COMMENTAIRES as appl_commentaires")
            // Informations techniques
            ->leftJoin('App\Entity\ENVIRONNEMENT', 'env', 'WITH', 'app.id = env.ID_APPLICATION')
            ->addSelect('env.NOM_SERVEUR as env_nomServeur', 'env.TYPE_APPLI as env_typeAppli')
            ->leftJoin('env.ID_SITE', 'sit')
            ->addSelect('sit.CODE_SITE as site_code')
            ->addSelect('env.DEV_LOCAUX as env_devLocaux', 'env.QUALIFIE as env_qualifie')
            ->leftJoin('env.BRIQUES', 'brq')
            ->addSelect('brq.LIB_BRIQUE as brq_lib')
            ->addSelect('env.IMPACT_MV_OS as env_impactOs', 'env.IMPACT_O365 as env_impactO365', 
                        'env.IMPACT_REORG as env_impactReorg', 'env.IMPACT_PROJET as env_impactProjet',
                        'env.DATE_REFORME as env_dateReforme', 'env.DATE_FIN_SUP as env_dateFinSup',)
            ->leftJoin('App\Entity\SUIVIMOE', 'suivi', 'WITH', 'suivi.ID_APPLICATION = app.id')
            ->addSelect('suivi.OBSOLESCENCE as suivi_obs', 'suivi.MV as suivi_mv', 'suivi.PORTAGE as suivi_portage',
                        'suivi.RAISON_PORTAGE as suivi_raisonPor', 'suivi.DATE_DEBUT as suivi_dateDebut',
                        'suivi.DATE_FIN as suivi_dateFin', 'suivi.COMMENTAIRES as suivi_commentaires')
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // Récupérer les informations techniques de chaque application pour export Excel (app_liste_apps_techniques_xlsx)
    public function findAllAppsTechniquesToExport() {
        return $this->createQueryBuilder('app')
            ->select('app.APPLICATION as app_lib')
            ->leftJoin('App\Entity\ENVIRONNEMENT', 'env', 'WITH', 'app.id = env.ID_APPLICATION')
            ->addSelect('env.NOM_SERVEUR as env_nomServeur', 'env.TYPE_APPLI as env_typeAppli')
            ->leftJoin('env.ID_SITE', 'sit')
            ->addSelect('sit.CODE_SITE as site_code')
            ->addSelect('env.DEV_LOCAUX as env_devLocaux', 'env.QUALIFIE as env_qualifie')
            ->leftJoin('env.BRIQUES', 'brq')
            ->addSelect('brq.LIB_BRIQUE as brq_lib')
            ->addSelect('env.IMPACT_MV_OS as env_impactOs', 'env.IMPACT_O365 as env_impactO365', 
                        'env.IMPACT_REORG as env_impactReorg', 'env.IMPACT_PROJET as env_impactProjet',
                        'env.DATE_REFORME as env_dateReforme', 'env.DATE_FIN_SUP as env_dateFinSup',)
            ->leftJoin('App\Entity\SUIVIMOE', 'suivi', 'WITH', 'suivi.ID_APPLICATION = app.id')
            ->addSelect('suivi.OBSOLESCENCE as suivi_obs', 'suivi.MV as suivi_mv', 'suivi.PORTAGE as suivi_portage',
                        'suivi.RAISON_PORTAGE as suivi_raisonPor', 'suivi.DATE_DEBUT as suivi_dateDebut',
                        'suivi.DATE_FIN as suivi_dateFin', 'suivi.COMMENTAIRES as suivi_commentaires')
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // Récupérer les informations fonctionnelles de chaque application pour export Excel (app_liste_apps_fonctionnelles_xlsx)
    public function findAllAppsFonctionnellesToExport() {
        return $this->createQueryBuilder('app')
            ->select("app.APPLICATION as appl_lib")
            ->leftjoin("app.ID_MOA", "moa")
            ->addSelect("moa.CODE_MOA as moa_code")
            ->leftJoin('app.CONTACT', 'user')
            ->addSelect('user.MATRICULE as user_matricule')
            ->leftjoin("app.ID_POLE", "amoapole")
            ->addSelect("amoapole.CODE_POLE as amoa_codePole")
            ->leftjoin("app.ID_EQUIPE", "amoaequipe")
            ->addSelect("amoaequipe.CODE_EQUIPE as amoa_codeEquipe")
            ->leftjoin("app.ID_ENTITE", "amoaentite")
            ->addSelect("amoaentite.CODE_ENTITE as amoa_codeEntite")
            ->leftjoin("app.ID_MOE", "moe")
            ->addSelect("moe.CODE_MOE as moe_code")
            ->leftjoin("app.ID_MOE_EXT", "moeext")
            ->addSelect("moeext.LIB_MOE_EXT as moeext_lib")
            ->leftjoin("app.ID_MOE_INT", "moeint")
            ->addSelect("moeint.CODE_EQ_MOE as moeint_codeEquipe", "moeint.CODE_UNITE_MOE as moeint_codeUnite",)
            ->leftjoin("app.ID_STATUT", "statut")
            ->addSelect("statut.LIB_STATUT as sta_lib")
            ->leftJoin('app.ID_ADM', 'admin')
            ->addSelect('admin.MATRICULE as admin_matricule')
            ->leftjoin("app.ID_REG", "regroupement")
            ->addSelect("regroupement.LIB_REG as reg_lib")
            ->addSelect("app.COMMENTAIRES as appl_commentaires")
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // Récupérer l'application en fonction de son id (app_modif_applis)
    public function findAppsById($id) {
        return $this->createQueryBuilder('app')
            ->select('app')
            ->where('app.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


//    /**
//     * @return APPLICATIONS[] Returns an array of APPLICATIONS objects
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

//    public function findOneBySomeField($value): ?APPLICATIONS
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
