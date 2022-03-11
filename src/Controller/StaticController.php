<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('static/index.html.twig');
    }

    #[Route('/what-we-do', name: 'what-we-do')]
    public function whatWeDo(): Response
    {
        return $this->render('static/whatWeDo.html.twig');
    }

    #[Route('/laboratory', name: 'laboratory')]
    public function laboratory(): Response
    {
        return $this->render('static/laboratory.html.twig');
    }

    #[Route('/about-us', name: 'about-us')]
    public function AboutUs(): Response
    {
        return $this->render('static/aboutUs.html.twig');
    }
}
