<?php

namespace App\Controller;

use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/rgpd', name: 'test')]
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController'
        ]);
    }
}
