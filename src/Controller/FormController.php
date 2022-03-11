<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\ContactType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demande = new Demande();
        $form = $this->createForm(ContactType::class, $demande);
        $form->handleRequest($request);
        $now = new DateTimeImmutable();
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $demande->setSendAt($now);
            $demande->setTraiter(false);
            $demande->setType("contact");
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
