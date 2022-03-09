<?php

namespace App\Controller;

use App\Entity\Protocol;
use App\Form\ProtocolType;
use App\Repository\ProtocolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/protocol')]
class ProtocolController extends AbstractController
{
    #[Route('/', name: 'app_protocol_index', methods: ['GET'])]
    public function index(ProtocolRepository $protocolRepository): Response
    {
        return $this->render('protocol/index.html.twig', [
            'protocols' => $protocolRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_protocol_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProtocolRepository $protocolRepository): Response
    {
        $protocol = new Protocol();
        $form = $this->createForm(ProtocolType::class, $protocol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $protocolRepository->add($protocol);
            return $this->redirectToRoute('app_protocol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('protocol/new.html.twig', [
            'protocol' => $protocol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_protocol_show', methods: ['GET'])]
    public function show(Protocol $protocol): Response
    {
        return $this->render('protocol/show.html.twig', [
            'protocol' => $protocol,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_protocol_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Protocol $protocol, ProtocolRepository $protocolRepository): Response
    {
        $form = $this->createForm(ProtocolType::class, $protocol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $protocolRepository->add($protocol);
            return $this->redirectToRoute('app_protocol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('protocol/edit.html.twig', [
            'protocol' => $protocol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_protocol_delete', methods: ['POST'])]
    public function delete(Request $request, Protocol $protocol, ProtocolRepository $protocolRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$protocol->getId(), $request->request->get('_token'))) {
            $protocolRepository->remove($protocol);
        }

        return $this->redirectToRoute('app_protocol_index', [], Response::HTTP_SEE_OTHER);
    }
}
