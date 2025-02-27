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
        $user_data = [
            'name' => 'John Doe',
            'Phone' => '123-456-7890',
            'email' => 'demo@email.com',
            'password' => 'demo',
            'role' => 'Admin',
            'status' => 'Active',
            'location' => 'New York, NY',
        ];
        $error = null;
        $session = $request->getSession();
        // Crear el formulario
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        
        // Procesar el envío del formulario
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($user_data as $key => $value) {
                $session->set($key, $value);
            }
            $data = $form->getData();
            // Validar credenciales fijas para la demo
            if ($data['email'] === $session->get('email') && $data['password'] === $session->get('password')) {
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
