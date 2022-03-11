<?php

namespace App\Controller;

use App\Core\Excel;
use App\Core\Stripe;
use App\Entity\Demande;
use App\Entity\Raport;
use App\Form\DevisType;
use App\Form\RaportType;
use App\Form\RapportType;
use App\Repository\EntrepriseRepository;
use App\Repository\RaportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

#[Route('/raport')]
class RaportController extends AbstractController
{
    #[Route('/', name: 'app_raport_index', methods: ['GET'])]
    public function index(RaportRepository $raportRepository): Response
    {
        return $this->render('raport/index.html.twig', [
            'raports' => $raportRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_raport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RaportRepository $raportRepository): Response
    {
        $raport = new Raport();
        $form = $this->createForm(RaportType::class, $raport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raportRepository->add($raport);
            return $this->redirectToRoute('app_raport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('raport/new.html.twig', [
            'raport' => $raport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_raport_show', methods: ['GET'])]
    public function show(Raport $raport): Response
    {
        return $this->render('raport/show.html.twig', [
            'raport' => $raport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_raport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Raport $raport, RaportRepository $raportRepository): Response
    {
        $form = $this->createForm(RaportType::class, $raport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raportRepository->add($raport);
            return $this->redirectToRoute('app_raport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('raport/edit.html.twig', [
            'raport' => $raport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_raport_delete', methods: ['POST'])]
    public function delete(Request $request, Raport $raport, RaportRepository $raportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$raport->getId(), $request->request->get('_token'))) {
            $raportRepository->remove($raport);
        }

        return $this->redirectToRoute('app_raport_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/pdf/generate', name: 'app_raport_generate', methods: ['GET','POST'])]
    public function generatePDF(Request $request,RaportRepository $raportRepository, EntrepriseRepository $entrepriseRepository, EntityManagerInterface $entityManager)
    {
        $count = 0;
        $user = $this->getUser();
        $form = $this->createForm(RaportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $data = $form->getData();
            $rapport = new Raport();
            $rapport->setUser($user);

            $antioxydant = 1;
            $moisturizing= 1;
            $barriere=1;
            $untreatedSkinAntioxydant = 1;
            $untreatedSkinMoisturizing = 1 ;
            $untreatedSkinBarriere = 1 ;

            $rapport->setPrice(($count-3)*5000);

            $excel = new Excel();
            $data2 = $excel->import($antioxydant,$moisturizing, $barriere,$untreatedSkinAntioxydant,$untreatedSkinMoisturizing,$untreatedSkinBarriere);


            $entityManager->persist($rapport);
            $entityManager->flush();

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

    #[Route('/create/devis', name: 'app_raport_devis')]
    public function devis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DevisType::class, $demande);
        $form->handleRequest($request);
        $now = new DateTimeImmutable();
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $demande->setSendAt($now);
            $demande->setTraiter(false);
            $demande->setType("devis");
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('app_raport_devis');
        }

        return $this->render('raport/devis.html.twig', [
            'devisForm' => $form->createView(),
        ]);
    }
}
