<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class AccueilController extends AbstractController
{
    public function accueil()
    {
        return $this->render('accueil/index.html.twig');
    }
}
