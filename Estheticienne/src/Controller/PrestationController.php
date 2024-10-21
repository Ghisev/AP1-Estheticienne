<?php

namespace App\Controller;

use App\Entity\PRESTATIONS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(Request $request): Response
    {
        // Récupérer le paramètre 'condition' depuis l'URL (GET), avec 'affichage1' par défaut
        $condition = $request->query->get('condition', 'affichage1');

        // Renvoyer la vue en passant le paramètre 'condition'
        return $this->render('prestation/index.html.twig', [
            'controller_name' => 'PrestationController',
            'condition' => $condition, // Passer la variable condition au template
        ]);
    }
}