<?php

namespace App\Controller;

use App\Core\Excel;
use App\Core\Stripe;
use App\Entity\Raport;
use DateTimeImmutable;
use App\Entity\Demande;
use App\Form\DevisType;
use App\Form\RaportType;
use App\Form\RapportType;
use App\Repository\RaportRepository;
use App\Repository\DemandeRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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

        #[Route('/devis', name: 'app_raport_devis', methods: ['GET', 'POST'])]
        public function devis(Request $request, DemandeRepository $demandeRepository): Response
        {
            $devis = new Demande();
            $form = $this->createForm(DevisType::class, $devis);
            $form->handleRequest($request);
            $now = new DateTimeImmutable();

            if ($form->isSubmitted() && $form->isValid()) {
                $devis->setSendAt($now);
                $devis->setTraiter(false);
                $devis->setType("devis");
                $demandeRepository->add($devis);
                return $this->redirectToRoute('app_raport_index', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('raport/devis.html.twig', [
                'raport' => $devis,
                'devisForm' => $form,
            ]);
        }

    #[Route('/{id}', name: 'app_raport_show', methods: ['GET'])]
    public function show(Raport $raport): Response
    {
        return $this->render('raport/show.html.twig', [
            'raport' => $raport,
        ]);
    }

    #[Route('/{id}', name: 'app_raport_delete', methods: ['POST'])]
    public function delete(Request $request, Raport $raport, RaportRepository $raportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $raport->getId(), $request->request->get('_token'))) {
            $raportRepository->remove($raport);
        }

        return $this->redirectToRoute('app_raport_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/pdf/generate', name: 'app_raport_generate', methods: ['GET','POST'])]
    public function generatePDF(Request $request, EntrepriseRepository $entrepriseRepository, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $form = $this->createForm(RapportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $rapport = new Raport();
            $rapport->setUser($user);
            $rapport->setPrice(50000);

            $antioxydant = 1;
            $moisturizing = 1;
            $barriere = 1;
            $untreatedSkinAntioxydant = 1;
            $untreatedSkinMoisturizing = 1;
            $untreatedSkinBarriere = 1;

            $excel = new Excel();
            $data2 = $excel->import($antioxydant, $moisturizing, $barriere, $untreatedSkinAntioxydant, $untreatedSkinMoisturizing, $untreatedSkinBarriere);

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
}
