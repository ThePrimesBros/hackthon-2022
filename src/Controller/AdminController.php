<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\RelanceType;
use Symfony\Component\Mime\Email;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin/relance', name: 'relance_admin')]
    public function relance(DemandeRepository $demandeRepository): Response
    {
        $demande = $demandeRepository->findAll();

        return $this->render('admin/relance.html.twig', [
            'controller_name' => 'AdminController',
            'demande' => $demande,
        ]);
    }

        #[Route('/admin/relance/{id}', name: 'email_admin')]
        public function mail(Demande $demande, Request $request, DemandeRepository $demandeRepository, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
        {
            $demande = $demandeRepository->find($demande);

            $form = $this->createForm(RelanceType::class);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                
                $demande->setTraiter(true);
                $demande->setContactEmail($data['Email']);
                $entityManager->persist($demande);
                $entityManager->flush();
    
                $email = (new Email())
                ->from('test@test.fr')
                ->to($data['Email'])
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($data['Sujet'])
                ->text($data['Contenu']);
    
                $mailer->send($email);
    
                return $this->redirectToRoute('relance_admin');
        }
        return $this->render('admin/test.html.twig', [
            'testForm' => $form->createView(),
            'demande' => $demande,
        ]);
    }
}
