<?php

namespace App\Controller;

use App\Entity\UTILISATEURS;
use App\Form\ChoixModifUtilisateursType;
use App\Form\UtilisateursType;
use App\Repository\UTILISATEURSRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateursController extends AbstractController
{
    public function listUtilisateurs(): Response
    {
        return $this->render('utilisateurs/liste.html.twig');
    }

    public function creerUtilisateurs(Request $request, EntityManagerInterface $em): Response
    {
        // Instanciation de notre classe 
        $user = new UTILISATEURS();

        // Création du formulaire
        $form = $this->createForm(UtilisateursType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persist des données
            $em->persist($user);
            $em->flush();

            // Message de confirmation...
            $this->addFlash(
                'msg',
                'L\'utilisateur a été correctement créée'
            );

            return $this->redirectToRoute('app_creer_utilisateur', []);
        }


        return $this->render('utilisateurs/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function choixModifUtilisateur(Request $request): Response
    {
        // Création du formulaire (EntityType::class -> UTILISATEURS::class)
        $form = $this->createForm(ChoixModifUtilisateursType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération de l'id de l'utilisateur choisi
            $data = $form->getData();
            $id = $data['UTILISATEURS']->getId();

            // On passe l'id en paramètre
            return $this -> redirectToRoute('app_modif_utilisateurs', ['id' => $id]);
        }

        return $this->render('utilisateurs/choixModif.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function modifierUtilisateur(Request $request, EntityManagerInterface $em, int $id, UTILISATEURSRepository $userRepo, ): Response
    {
        // Récupération l'id précédemment passé en paramètre
        $id = $request->get('id');
        // Récupération des données de l'utilisateur
        $UTILISATEUR = $userRepo->findUtilisateursById($id);

        // Création du formulaire
        $form= $this->createForm(UtilisateursType::class, $UTILISATEUR);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persist des données
            $em->persist($UTILISATEUR);
            $em->flush();

            // Message de confirmation...
            $this->addFlash(
                'msg',
                'L\'Utilisateur a été correctement modifié'
            );

            return $this -> redirectToRoute('app_choix_modif_utilisateurs');
        }

        return $this->render('utilisateurs/modifier.html.twig', [
            'form' => $form->createView(),
            'nomUser' => $UTILISATEUR
        ]);

        return $this->render('utilisateurs/modifier.html.twig');
    }

    public function listUtilisateursToJson(UTILISATEURSRepository $userRepo): Response
    {
        // Récupération des données au format array()
        $listUtilisateurs = $userRepo->findAllUtilisateursToArray(); 

        // Envoi des données au format JSON -> JqxGrid (gridUtilisateurs.js)
        return new JsonResponse($listUtilisateurs);
    }

    public function listUtilisateursToExport(UTILISATEURSRepository $userRepo): Response 
    {
        //Récupération des données
        $listUtilisateurs = $userRepo->findAllUtilisateursToExport();

        // Création du fichier XLSX
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Utilisateurs');

        // Création des entêtes
        $rowHeaders = array('Compte matriculaire', 'Nom', 'Prénom', 'Rôle');
        $sheet->fromArray($rowHeaders, NULL, 'A1');

        // Application des styles aux entêtes
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
            'border' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('rgb' => 'FFFFFF')
                )
            )
        );
        $sheet->getStyle('A1:D1')->applyFromArray($styleArray);

        // Ajustement automatique de la largeur des colonnes
        for($col = 0; $col <= (count($rowHeaders)); $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setAutoSize(true);
        }

        // Insertion des données
        $sheet->fromArray($listUtilisateurs, NULL, 'A2');

        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        return new Response(ob_get_clean(), 200, array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="exportUtilisateurs_'.date('Y-m-d_His').'.xlsx"',
            'Cache-Control' => 'max-age=0'
        ));  
    }
}
