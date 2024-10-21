<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $avisRepository = $em->getRepository(Avis::class);
        $lesAvis = $avisRepository->findAll();

        return $this->render('avis/index.html.twig', [
            'lesAvis' => $lesAvis,
        ]);
    }

    #[Route('/ajoutAvis', name: 'app_ajoutAvis')]
    public function ajoutAvis(Request $request, EntityManagerInterface $em): Response
    {   
        // Ensure only logged-in users can add reviews
        $this->denyAccessUnlessGranted('ROLE_USER');

        $avis = new Avis();
        $formAjoutAvis = $this->createForm(AvisType::class, $avis);
        
        $formAjoutAvis->handleRequest($request);

        if ($formAjoutAvis->isSubmitted() && $formAjoutAvis->isValid()) {
            // Get the current logged-in user
            $user = $this->getUser();

            // Set the user for the Avis entity
            $avis->setUser($this->getUser());

            // Persist the Avis entity and save to the database
            $em->persist($avis);
            $em->flush();

            // Add a success message and redirect
            $this->addFlash('success', 'Votre avis a été publié');

            return $this->redirectToRoute('app_avis');
        }

        return $this->render('avis/ajouterAvis.html.twig', [
            'formAjoutAvis' => $formAjoutAvis->createView(),
        ]);
    }

    #[Route('/supprimerAvis/{id}', name: 'app_supprimerAvis')]
    public function supprimerAvis(Request $request, EntityManagerInterface $em, int $id): Response
    {   
        // Only admin can delete reviews
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $avis = $em->getRepository(Avis::class)->find($id);
        
        if (!$avis) {
            return $this->redirectToRoute('app_avis');
        }

        // Check the CSRF token before deleting
        if ($this->isCsrfTokenValid('delete' . $avis->getId(), $request->request->get('_token'))) {
            $em->remove($avis);
            $em->flush();
        }

        // Redirect to the reviews page after deletion
        return $this->redirectToRoute('app_avis');
    }
}