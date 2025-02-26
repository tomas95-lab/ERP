<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(Request $request): Response
    {
        // Procesar el argumento 'access'
        $session = $request->getSession();
        if ($session === null) {
            return $this->redirectToRoute('login');
        }
        $user = $session->get('user');
        
        return $this->render('dashboard.html.twig', [
            'user' => $user,
        ]);
    }
}
