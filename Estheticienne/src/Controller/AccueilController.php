<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\PresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Presentation;
use App\Form\AccueilEditType;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(PresentationRepository $presentationRepository): Response
    {
        $presentations = $presentationRepository->findAll();
        $lapresentation = [];
        foreach ($presentations as $presentation) {
            $lapresentation[] = [
                'id' => $presentation ? $presentation->getId() : 'Aucun id trouvé',
                'presentation' => $presentation->getPresentation(),
            ];
        }
        return $this->render('accueil/index.html.twig', [
            'lapresentation' => $lapresentation,
        ]);
    }

    #[Route('/accueil_edit/{id}', name: 'accueil_edit')]
    public function modifier(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $presentationEdit = $em->getRepository(Presentation::class)->find($id);

        $leFormulaire = $this->createForm(AccueilEditType::class, $presentationEdit);
        $leFormulaire->handleRequest($request);
        if ($leFormulaire->isSubmitted() && $leFormulaire->isValid()) {
            $em->persist($presentationEdit);
            $em->flush();
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('accueil/edit.html.twig', [
            'presentationEdit' => $presentationEdit,
            'leFormulaire' => $leFormulaire
        ]);
    }
}
