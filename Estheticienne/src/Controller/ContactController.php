<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactRepository $contactRepository, EntityManagerInterface $em): Response
    {
        $contacts = $contactRepository->findAll(); // Récupérer tous les contacts

        $contact = new Contact(); // Créer une nouvelle instance de Contact
        $form = $this->createForm(ContactType::class, $contact); // Créer le formulaire
        $form->handleRequest($request); // Gérer la requête

        // Vérifier si l'utilisateur a déjà laissé un contact
        $user = $this->getUser();
        $existingContact = $contactRepository->findOneBy(['user' => $user]);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($existingContact) {
                // Si l'utilisateur a déjà laissé un contact, ajouter un message flash
                $this->addFlash('error', 'Vous avez déjà laissé votre contact.');
            } else {
                // Associer l'utilisateur connecté et persister le contact
                $contact->setUser($user);
                $em->persist($contact);
                $em->flush();

                $this->addFlash('success', 'Votre contact a été ajouté avec succès.');
                return $this->redirectToRoute('app_contact'); // Rediriger après l'ajout
            }
        }

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }


    #[Route('/contact/ajouter', name: 'app_ajout_contact')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setUser($this->getUser());
            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', 'Votre contact a été ajouté avec succès.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/{id}/supprimer', name: 'app_supprimer_contact')]
    public function supprimer(Contact $contact, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em->remove($contact);
        $em->flush();

        $this->addFlash('success', 'Le contact a été supprimé.');
        return $this->redirectToRoute('app_contact');
    }
}
