<?php

namespace App\Controller;

use App\Entity\APPLICATIONS;
use App\Entity\ENVIRONNEMENT;
use App\Entity\SUIVIMOE;
use App\Form\FiltreListeType;
use App\Form\ChoixModifApplisType;
use App\Form\ModifENVType;
use App\Form\ModifierApplisType;
use App\Form\ModifSUIVIType;
use App\Form\ApplicationsType;
use App\Repository\ENVIRONNEMENTRepository;
use App\Repository\SUIVIMOERepository;
use App\Repository\APPLICATIONSRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationsController extends AbstractController
{
    public function creerApplis(Request $request, EntityManagerInterface $em, APPLICATIONSRepository $appRepo) 
    {
        // Instanciation de nos classes
        $applis = new APPLICATIONS();
        $env = new ENVIRONNEMENT();
        $suivi = new SUIVIMOE();

        // Création du formulaire
        $form = $this->createForm(ApplicationsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération des données du formulaire (table APPLICATIONS)
            $APPLICATION = $form->get('APPLICATION')->getData();
            $VERSION = $form->get('VERSION')->getData();
            $FINALITE = $form->get('FINALITE')->getData();
            $DESCRIPTION = $form->get('DESCRIPTION')->getData();
            $ID_MOA = $form->get('ID_MOA')->getData();
            $ID_ENTITE = $form->get('ID_ENTITE')->getData();
            $ID_EQUIPE = $form->get('ID_EQUIPE')->getData();
            $ID_POLE = $form->get('ID_POLE')->getData();
            $CONTACT = $form->get('CONTACT')->getData();
            $ID_MOE = $form->get('ID_MOE')->getData();
            $ID_MOE_INT = $form->get('ID_MOE_INT')->getData();
            $ID_MOE_EXT = $form->get('ID_MOE_EXT')->getData();
            $ID_STATUT = $form->get('ID_STATUT')->getData();
            $ID_REG = $form->get('ID_REG')->getData();
            $ID_ADM = $form->get('ID_ADM')->getData();
            $COMMENTAIRES = $form->get('COMMENTAIRES')->getData();

            // Insertion des données dans la table APPLICATIONS 
            $applis->setAPPLICATION($APPLICATION);
            $applis->setVERSION($VERSION);
            $applis->setIDMOA($ID_MOA);
            $applis->setFINALITE($FINALITE);
            $applis->setDESCRIPTION($DESCRIPTION);
            $applis->setIDPOLE($ID_POLE);
            $applis->setIDENTITE($ID_ENTITE);
            $applis->setIDEQUIPE($ID_EQUIPE);
            $applis->setCONTACT($CONTACT);
            $applis->setIDMOE($ID_MOE);
            $applis->setIDMOEEXT($ID_MOE_EXT);
            $applis->setIDMOEINT($ID_MOE_INT);
            $applis->setIDSTATUT($ID_STATUT);
            $applis->setIDREG($ID_REG);
            $applis->setIDADM($ID_ADM);
            $applis->setCOMMENTAIRES($COMMENTAIRES);

            // Persist des données
            $em->persist($applis);
            $em->flush();

            // Récupération de l'id de l'application qui viens d'être créee
            $id = $applis->getId();
            $ID_APPLICATION = $appRepo->findOneBy(['id' => $id]);

            // Récupération des données du formulaire (table ENVIRONNEMENT)
            $NOM_SERVEUR = $form->get('NOM_SERVEUR')->getData();
            $TYPE_APPLI = $form->get('TYPE_APPLI')->getData();
            $DEV_LOCAUX = $form->get('DEV_LOCAUX')->getData();
            $ID_SITE = $form->get('ID_SITE')->getData();
            $QUALIFIE = $form->get('QUALIFIE')->getData();
            $DATE_REFORME = $form->get('DATE_REFORME')->getData();
            $DATE_FIN_SUP = $form->get('DATE_FIN_SUP')->getData();
            $IMPACT_MV_OS = $form->get('IMPACT_MV_OS')->getData();
            $IMPACT_REORG = $form->get('IMPACT_REORG')->getData();
            $IMPACT_O365 = $form->get('IMPACT_O365')->getData();
            $IMPACT_PROJET = $form->get('IMPACT_PROJET')->getData();
            $ID_CYBER = $form->get('ID_CYBER')->getData();
            $AUTH = $form->get('AUTH')->getData();
            $FLUX_IN = $form->get('FLUX_IN')->getData();
            $TYPE_FLUX_IN = $form->get('TYPE_FLUX_IN')->getData();
            $FLUX_OUT = $form->get('FLUX_OUT')->getData();
            $TYPE_FLUX_OUT = $form->get('TYPE_FLUX_OUT')->getData();
            $TYPE_ACCES = $form->get('TYPE_ACCES')->getData();
            $BRIQUES = $form->get('BRIQUES')->getData();

            // Insertion des données dans la table ENVIRONNEMENT
            $env->setIDAPPLICATION($ID_APPLICATION);
            $env->setNOMSERVEUR($NOM_SERVEUR);
            $env->setTYPEAPPLI($TYPE_APPLI);
            $env->setDEVLOCAUX($DEV_LOCAUX);
            $env->setIDSITE($ID_SITE);
            $env->setQUALIFIE($QUALIFIE);
            $env->setDATEREFORME($DATE_REFORME);
            $env->setDATEFINSUP($DATE_FIN_SUP);
            $env->setIMPACTMVOS($IMPACT_MV_OS);
            $env->setIMPACTO365($IMPACT_O365);
            $env->setIMPACTREORG($IMPACT_REORG);
            $env->setIMPACTPROJET($IMPACT_PROJET);
            $env->setIDCYBER($ID_CYBER);
            $env->setAUTH($AUTH);
            $env->setFLUXIN($FLUX_IN);
            $env->setTYPEFLUXIN($TYPE_FLUX_IN);
            $env->setFLUXOUT($FLUX_OUT);
            $env->setTYPEFLUXOUT($TYPE_FLUX_OUT);
            $env->setTYPEACCES($TYPE_ACCES);
            $env->addBRIQUES($BRIQUES);

            $em->persist($env);
            $em->flush();

            // Récupératon des données du formulaire (table SUIVI_MOE)
            $OBSOLESCENCE = $form->get('OBSOLESCENCE')->getData();
            $MV = $form->get('MV')->getData();
            $TYPE_MV = $form->get('TYPE_MV')->getData();
            $PORTAGE = $form->get('PORTAGE')->getData();
            $TYPE_PORTAGE = $form->get('TYPE_PORTAGE')->getData();
            $RAISON_PORTAGE = $form->get('RAISON_PORTAGE')->getData();
            $STATUT_SUIVI = $form->get('STATUT_SUIVI')->getData();
            $DATE_DEBUT = $form->get('DATE_DEBUT')->getData();
            $DATE_FIN = $form->get('DATE_FIN')->getData();
            $COMMENTAIRES_SUIVI = $form->get('COMMENTAIRES_SUIVI')->getData();

            // Insertion des données dans la table SUIVI_MOE
            $suivi->setIDAPPLICATION($ID_APPLICATION);
            $suivi->setOBSOLESCENCE($OBSOLESCENCE);
            $suivi->setMV($MV);
            $suivi->setTYPEMV($TYPE_MV);
            $suivi->setPORTAGE($PORTAGE);
            $suivi->setTYPEPORTAGE($TYPE_PORTAGE);
            $suivi->setRAISONPORTAGE($RAISON_PORTAGE);
            $suivi->setSTATUTSUIVI($STATUT_SUIVI);
            $suivi->setDATEDEBUT($DATE_DEBUT);
            $suivi->setDATEFIN($DATE_FIN);
            $suivi->setCOMMENTAIRES($COMMENTAIRES_SUIVI);

            $em->persist($suivi);
            $em->flush();

            // Message de confirmation...
            $this->addFlash(
                'msg',
                'L\'application a été correctement créée'
            );

            return $this->redirectToRoute('app_creer_applis', []);
        }

        return $this->render('applications/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Formulaire du choix de l'application à modifier ( EntityType::class - App\Entity\APPLICATIONS)
    public function choixmodifApplis(Request $request) 
    {
        // Création du formulaire
        $form = $this->createForm(ChoixModifApplisType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération de l'id de l'application choisie
            $data = $form->getData();
            $id = $data['NOM_APPLICATION']->getId();

            // On passe l'id en paramètre
            return $this -> redirectToRoute('app_modif_applis', ['id' => $id]);
        }

        return $this->render('applications/choixModif.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function modifierApplis(Request $request, EntityManagerInterface $em, int $id, APPLICATIONSRepository $appRepo, ENVIRONNEMENTRepository $envRepo, SUIVIMOERepository $suiviRepo) 
    {
        // Récupération de l'id ainsi que les données des tables (APPLICATIONS, ENVIRONNEMENT, SUIVIE_MOE) en fonction de l'id reçu
        $id = $request->get('id');
        $APPLICATIONS = $appRepo->findAppsById($id);
        $ENVIRONNEMENT = $envRepo->findEnvById($id);
        $SUIVI = $suiviRepo->findSuiviById($id);


        // Création des formulaires
        $form2 = $this->createForm(ModifierApplisType::class, $APPLICATIONS);
        $form2->handleRequest($request);

        $form3 = $this->createForm(ModifENVType::class, $ENVIRONNEMENT);
        $form3->handleRequest($request);

        $form4 = $this->createForm(ModifSUIVIType::class, $SUIVI);
        $form4->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {

            // Persist de toutes les données modifiées
            $em->persist($APPLICATIONS);
            $em->flush();

            $em->persist($ENVIRONNEMENT);
            $em->flush();

            $em->persist($SUIVI);
            $em->flush();

            // Message de confirmation...
            $this->addFlash(
                'msg',
                'L\'Application a été correctement modifiée'
            );

            return $this -> redirectToRoute('app_choix_modif_applis');
        }

        return $this->render('applications/modifier.html.twig', [
            'form2' => $form2->createView(),
            'form3' => $form3->createView(),
            'form4' => $form4->createView(),
            'nomApp' => $APPLICATIONS
        ]);
    }

    public function listApplis(Request $request) 
    {
        // Création du formulaire de tri
        $form = $this->createForm(FiltreListeType::class);
        $form->handleRequest($request);

        // Valeur de base des checkbox (pour le tri)
        $isChecked1 = 0;
        $isChecked2 = 0;
        $isAllChecked = 0; 

        if ($form -> isSubmitted() && $form -> isValid()){

            // Récupération des données des checkbox
            $data1 = $form->get('check1')->getData();
            $data2 = $form->get('check2')->getData();

            if ($data1 == true && $data2 == false){
                $isChecked1 = 1;
            } elseif ($data1 == false && $data2 == true){
                $isChecked2 = 1;
            } elseif ($data1 == true && $data2 == true){
                $isAllChecked = 1;
            } else {
                $isAllChecked = 1;
            }
        }

        return $this->render('applications/liste.html.twig', [
            'filtrelisteForm' => $form->createView(),
            'isChecked1' => $isChecked1,
            'isChecked2' => $isChecked2,
            'isAllChecked' => $isAllChecked,
        ]);
    }

    public function listApplisToJson(APPLICATIONSRepository $app) 
    {
        // Récupération des données au format array()
        $listApplis = $app->findAllAppsSQLToArray();

        // Envoi des données au format JSON -> JqxGrid (gridAll.js)
        return new JsonResponse($listApplis);
    }

    public function listApplisFonctionnellesToJson(APPLICATIONSRepository $app) 
    {
        // Récupération des données au format array()
        $listApplisFonct = $app->findAllAppsFonctionnellesToExport();

        // Envoi des données au format JSON -> JqxGrid (gridAppFonctio.js)
        return new JsonResponse($listApplisFonct);
    }

    public function listApplisTechniquesToJson(APPLICATIONSRepository $app)
    {
        // Récupération des données au format array()
        $listApplisFonct = $app->findAllAppsTechniquesSQLToArray();

        // Envoi des données au format JSON -> JqxGrid (gridAppTechnique.js)
        return new JsonResponse($listApplisFonct);
    }

    public function listApplisToXlsx(APPLICATIONSRepository $appRepo)
    {
        // Récupération des applications
        $listApplis = $appRepo->findAllAppsSQLToArray();


        // Création du fichier XLSX
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Applications');

        // Création des entêtes
        $rowHeaders = array(
            'Application', 'MOA', 'Contact', 'Pôle AMOA', 'Equipe AMOA', 'Entite AMOA', 'MOE', 'MOE externe',
            'Equipe MOE', 'Unité MOE', 'Statut', 'Regroupement', 'Commentaire(s)',
            'Nom serveur', 'Type d\'appli', 'Site', 'Type d\'acces', 'Developpeur locaux ?', 'Dispo centre logiciel ?',
            'Briques(s)', 'Impact montée de version ?', 'Impact réorganisation ?', 'Dépendance O365 ?', 'Impact projet ?', 'Flux entrant',
            'Flux sortant', 'Cyber', 'Date de réforme', 'Date fin de support', 'Obsolescence ?', 'Montée de version à prévoir ?', 
            'Portage technique à prévoir ?', 'Raisons du portage', 'Statut du suivi', 'Date de début du suivi', 'Date de fin du suivi', 'Commentaire(s)'
        );
        $sheet->fromArray($rowHeaders, NULL, 'A1');

        // Création du style des entêtes
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF')
            ),
            'fill' => array(
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => array('argb' => 'FF2191C0'),
                'endColor' => array('argb' => 'FF2AAFDE'),
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => 'FFFFFF'),
                )
            )
        );
        $sheet->getStyle('A1:AK1')->applyFromArray($styleArray);

        // Ajustement automatique des largeurs des colonnes
        for($col = 0; $col <= (count($rowHeaders)); $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setAutoSize(true);
        }

        // Alignement horizontal des valeurs
        $sheet->getStyle('B2:C'.(sizeof($listApplis)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2:D'.(sizeof($listApplis)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:E'.(sizeof($listApplis)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:F'.(sizeof($listApplis)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2:G'.(sizeof($listApplis)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Insertion les données
        $sheet->fromArray($listApplis, NULL, 'A2');

        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        return new Response(ob_get_clean(), 200, array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="exportApplis_'.date('Y-m-d_His').'.xlsx"',
        ));
    }

    public function listApplisTechniquesToXlsx(APPLICATIONSRepository $appRepo)  
    {
        // Récupération des applications (informations techniques)
        $listApplisTech = $appRepo->findAllAppsTechniquesSQLToArray();

        // Création du fichier XLSX
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Informations techniques');

        // Création des entêtes
        $rowHeaders = array(
            'Application', 'Nom serveur', 'Type d\'appli', 'Site', 'Developpeur locaux ?', 'Dispo centre logiciel ?',
            'Briques(s)', 'Flux entrant', 'Flux sortant', 'Impact montée de version ?', 'Dépendance O365 ?', 'Impact réorganisation ?', 'Impact projet ?',
            'Date de réforme', 'Date fin de support', 'Obsolescence ?', 'Montée de version à prévoir ?', 'Portage technique à prévoir ?', 
            'Raisons du portage', 'Date de début du suivi', 'Date de fin du suivi', 'Commentaire(s)'
        );
        $sheet->fromArray($rowHeaders, NULL, 'A1');

        // Création du style des entêtes
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF')
            ),
            'fill' => array(
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => array('argb' => 'FF2191C0'),
                'endColor' => array('argb' => 'FF2AAFDE') 
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => 'FFFFFF')
                )
            )
        );
        $sheet->getStyle('A1:V1')->applyFromArray($styleArray);

        // Ajustement automatique des largeurs des colonnes
        for($col = 0; $col <= (count($rowHeaders)); $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setAutoSize(true);
        }

        // Alignement horizontal des valeurs
        $sheet->getStyle('D2:E'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:F'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('F2:G'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('P2:Q'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('Q2:R'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('R2:S'.(sizeof($listApplisTech)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Insertion des données
        $sheet->fromArray($listApplisTech, NULL, 'A2');

        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        return new Response(ob_get_clean(), 200, array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="exportApplisTechniques_'.date('Y-m-d_His').'.xlsx"',
        ));
    }

    public function listApplisFonctionnellesToXlsx(APPLICATIONSRepository $appRepo) 
    {
        // Récupération des données
        $listApplisFonct = $appRepo->findAllAppsFonctionnellesToExport();

        // Création du fichier XLSX
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Informations fonctionnelles');

        // Création des entêtes
        $rowHeaders = array(
            'Application', 'MOA', 'Contact', 'Pôle AMOA', 'Equipe AMOA', 'Entite AMOA', 'MOE', 'MOE externe',
            'Equipe MOE', 'Unité MOE', 'Statut', 'Admin', 'Regroupement', 'Commentaire(s)');
        $sheet->fromArray($rowHeaders, NULL, 'A1');

        $sheet->setTitle('Applications');

        // Création du style des entêtes
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF')
            ),
            'fill' => array(
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => array('argb' => 'FF2191C0'),
                'endColor' => array('argb' => 'FF2AAFDE'),
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => 'FFFFFF'),
                )
            )
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);

        // Ajustement automatique des largeurs des colonnes
        for($col = 0; $col <= (count($rowHeaders)); $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setAutoSize(true);
        }

        // Alignement horizontal des valeurs
        $sheet->getStyle('B2:C'.(sizeof($listApplisFonct)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2:D'.(sizeof($listApplisFonct)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:E'.(sizeof($listApplisFonct)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:F'.(sizeof($listApplisFonct)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2:G'.(sizeof($listApplisFonct)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Insertion des données
        $sheet->fromArray($listApplisFonct, NULL, 'A2');

        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        return new Response(ob_get_clean(), 200, array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="exportApplisFonctionnelles_'.date('Y-m-d_His').'.xlsx"',
        ));
    }
}
