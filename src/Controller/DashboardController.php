<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard/{access}', name: 'dashboard')]
    public function index(Request $request, $access): Response
    {
        // Procesar el argumento 'access'
        return $this->render('dashboard.html.twig', [
            'access' => $access,
        ]);
    }
}
