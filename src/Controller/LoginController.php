<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;

class LoginController extends AbstractController
{
    #[Route('/', name: 'login')]
    public function index(Request $request): Response
    {
        $error = null;
        $session = $request->getSession();
        // Crear el formulario
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        // Procesar el envío del formulario
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // Validar credenciales fijas para la demo
            if ($data['email'] === 'demo@email.com' && $data['password'] === 'demo') {
                $session = $request->getSession();
                $session->set('user', $data['email']);
                return $this->redirectToRoute('dashboard');
            } else {
                $error = 'Invalid Credentials. Please Try Again.';
            }
        }
        
        return $this->render('login.html.twig', [
            'loginForm' => $form->createView(),
            'error'     => $error,
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function logout(Request $request): Response
    {
        $request->getSession()->invalidate();
        return $this->redirectToRoute('login');
    }
}
