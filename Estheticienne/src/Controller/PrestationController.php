<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(Request $request, PrestationRepository $prestationRepository): Response
    {
        $condition = $request->query->get('condition', 'affichage1');
        $categorieMap = [
            'affichage1' => 1, 
            'affichage2' => 2,
            'affichage3' => 3,
        ];
        $categorie = $categorieMap[$condition] ?? 1;
        $prestations = $prestationRepository->findBy(['categorie' => $categorie]);

        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestations,
            'condition' => $condition,
        ]);
    }

    #[Route('/prestation/ajouter', name: 'app_prestation_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $prestation = new Prestation();
        
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prestation);
            $em->flush();

            $this->addFlash('success', 'La prestation a été ajoutée avec succès.');

            return $this->redirectToRoute('app_prestation');
        }

        return $this->render('prestation/ajouter.html.twig', [
            'formAjouterPrestation' => $form->createView(),
        ]);
    }

    #[Route('/prestation/{id}/modifier', name: 'app_prestation_modifier')]
    public function modifierPrestation(Request $request, Prestation $prestation, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La prestation a été modifiée avec succès.');
            return $this->redirectToRoute('app_prestation');
        }

        return $this->render('prestation/modifier.html.twig', [
            'formModifierPrestation' => $form->createView(),
            'prestation' => $prestation,
        ]);
    }

    #[Route('/prestation/{id}/supprimer', name: 'app_prestation_supprimer')]
    public function supprimerPrestation(Request $request, Prestation $prestation, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete' . $prestation->getId(), $request->request->get('_token'))) {
            $em->remove($prestation);
            $em->flush();
        }

        return $this->redirectToRoute('app_prestation');
    }
}
