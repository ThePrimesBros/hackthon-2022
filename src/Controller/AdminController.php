<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Core\Excel;
use Dompdf\Options;
use App\Entity\Demande;
use App\Form\RapportType;
use App\Form\RelanceType;
use App\Form\NewsletterType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\DemandeRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
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

    #[Route('/admin/newsletter', name: 'newsletter_admin')]
    public function newsletter(Request $request, UserRepository $userRepository, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findAll();

        $form = $this->createForm(NewsletterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            for ($i = 1; $i <= count($user); $i++) {
                if (isset($_POST['prospect' . $i])) {
                    $email = (new Email())
                        ->from('test@test.fr')
                        ->to($_POST['prospect' . $i])
                        //->cc('cc@example.com')
                        //->bcc('bcc@example.com')
                        //->replyTo('fabien@example.com')
                        //->priority(Email::PRIORITY_HIGH)
                        ->subject($data['Sujet'])
                        ->text($data['Contenu']);

                    $mailer->send($email);
                }
            }

            return $this->redirectToRoute('newsletter_admin');
        }
        return $this->render('admin/newsletter.html.twig', [
            'newsletterForm' => $form->createView(),
            'users' => $user,
        ]);
    }
    #[Route('/admin/translate/{locale}', name: 'translate_admin')]
    public function changeLocale($locale, Request $request)
    {
        // On stocke la langue dans la session
        $request->getSession()->set('_locale', $locale);

        // On revient sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/admin/generate', name: 'generate_admin')]
    public function generatePDF(Request $request, EntrepriseRepository $entrepriseRepository)
    {

        $form = $this->createForm(RapportType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            $antioxydant = 1;
            $moisturizing= 1;
            $barriere=0;
    
            $excel = new Excel();
            $data2 = $excel->import($antioxydant,$moisturizing, $barriere);

            
            $entreprise = $entrepriseRepository->findOneBy(["name" => $data['entreprise']]);

            return $this->render('default/mypdf.html.twig', [
                'data' => $data,
                'entreprise' => $entreprise,
                'data2' => $data2
            ]);
        }
            return $this->render('admin/generate.html.twig', [
                'rapportForm' => $form->createView(),
            ]);
    }
}
