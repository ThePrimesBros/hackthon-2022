<?php

namespace App\Controller;

use App\Entity\Raport;
use App\Form\RaportType;
use App\Repository\RaportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
