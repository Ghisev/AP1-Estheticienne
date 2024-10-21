<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $avisRepository=$em->getRepository(Avis::class);
        $lesAvis=$avisRepository->findAll();

        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'lesAvis' => $lesAvis,
        ]);
    }

    #[Route('/ajoutAvis', name: 'app_ajoutAvis')]
    public function ajoutPiece(Request $request, EntityManagerInterface $em): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');
        $avis = new Avis();
        $formAjoutAvis = $this->createForm(AvisType::class, $avis);
        
        $formAjoutAvis->handleRequest($request);

        if($formAjoutAvis->isSubmitted() && $formAjoutAvis->isvalid()){

            $user = $this->getUser();
            $avis->setUserId($user);

            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Votre avis a été publié');

            return $this->redirectToRoute('app_avis');
        }

        return $this->render('avis/ajouterAvis.html.twig', [
            'formAjoutAvis' => $formAjoutAvis->createView(),
        ]);
    }

    #[Route('/supprimerAvis{id}', name: 'app_supprimerAvis')]
    public function supprimmerAvis(Request $request, EntityManagerInterface $em, int $id): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $avis = $em->getRepository(Avis::class)->find($id);
        
        if (!$avis) {
            return $this->redirectToRoute('app_avis'); 
        }

        if ($this->isCsrfTokenValid('delete' . $avis->getId(), $request->request->get('_token'))) {
            $em->remove($avis);
            $em->flush();
        } 
        else {

        }

        $avisRepository=$em->getRepository(Avis::class);
        $lesAvis=$avisRepository->findAll();

        return $this->render('avis/index.html.twig', [
            'lesAvis' => $lesAvis,
        ]);
    }
}
