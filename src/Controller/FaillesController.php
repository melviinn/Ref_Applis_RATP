<?php

namespace App\Controller;

use App\Entity\FAILLES;
use App\Form\FaillesType;
use App\Repository\FAILLESRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class FaillesController extends AbstractController
{
    public function listFailles()
    {
        return $this->render('failles/liste.html.twig');
    }

    public function detailsFailles(Request $request, FAILLESRepository $faillesRepo, $id)
    {
        // Récupération de l'id de la faille choisie dans le tableau JqxGrid (gridDetailsFailles.js)
        $id = $request->get('id');
        // Récupération du libellé de la faille (On récupère l'entité puis le libellé grâce à la fonction __toString())
        $faille_lib = $faillesRepo->findOneBy(['id' => $id]);

        return $this->render('failles/details.html.twig', [
            'faille_lib' => $faille_lib,
            'faille_id' => $id
        ]);
    }

    public function creerFailles(Request $request, EntityManagerInterface $em)
    {
        // Instanciation de notre classe
        $failles = new FAILLES();

        // Création du formulaire
        $form = $this->createForm(FaillesType::class, $failles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persist des données
            $em->persist($failles);
            $em->flush();

            // Message de confirmation...
            $this->addFlash(
                'msg',
                'La faille a été correctement créée'
            );

            return $this->redirectToRoute('app_creer_failles', []);
        }

        return $this->render('failles/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function listFaillesToJson(FAILLESRepository $faillesRepo)
    {
        // Récupération des données au format array()
        $listFailles = $faillesRepo->findAllFaillesSQLToArray();

        // Envoi des données au format JSON -> JqxGrid (gridFailles.js)
        return new JsonResponse($listFailles);
    }

    public function detailsFaillesToJson(Request $request, FAILLESRepository $faillesRepo)
    {
        // Récupération de l'id de la faille
        $faille_id = $request->get('faille_id');
        // Récupération des détails de chaque faille en fonction de son id aux format array()
        $listFailles = $faillesRepo->findDetailsFaillesSQLById($faille_id);

        // Envoir des données au format JSON ->JqxGrid (gridDetailsFailles.js)
        return new JsonResponse($listFailles);
    }

    public function listFaillesToXlsx(FAILLESRepository $faillesRepo)
    {
        // Récupération des données
        $listFailles = $faillesRepo->findAllFaillesSQLToExport();

        // Création du fichier XLSX
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Failles');

        // Création des entêtes
        $rowHeaders = array(
            'Vulnérabilités', 'Composant impacté', 'Date d\'identification', 'Nb applications impactées',
            'Statut du traitement', 'Date de traitement'
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
                    'color' => array('rgb' => 'FFFFFF')
                )
            )
        );
        $sheet->getStyle('A1:F1')->applyFromArray($styleArray);

        // Ajustement automatique de la largeur des colonnes
        for ($col = 0; $col <= (count($rowHeaders)); $col++) {
            $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colString)->setAutoSize(true);
        }

        $sheet->getStyle('D2:E'.(sizeof($listFailles)+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Insertion des données
        $sheet->fromArray($listFailles, NULL, 'A2');

        ob_start();
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        return new Response(ob_get_clean(), 200, array(
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="exportFailles_'.date('Y-m-d_His').'.xlsx"',
            'Cache-Control' => 'max-age=0'
        )); 
    }
}
