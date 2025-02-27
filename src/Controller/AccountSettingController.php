<?php

namespace App\Controller;

use App\Form\AccountSettingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class AccountSettingController extends AbstractController
{
    #[Route('/account/setting', name: 'app_account_setting')]
    public function index(Request $request): Response
    {
        $actual_page = 'Account Settings';
        $session = $request->getSession();
        
        if ($session === null) {
            return $this->redirectToRoute('login');
        }
        
        $session->set('actual_page', $actual_page);

        $accountData = [
            'name'     => $session->get('name', 'John Doe'),
            'email'    => $session->get('email', 'demo@email.com'),
            'phone'    => $session->get('phone', '123-456-7890'),
            'location' => $session->get('location', 'New York, NY'),
        ];


        $form = $this->createForm(AccountSettingType::class, $accountData);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();  
        
            $session->set('name', $data['name']);
            $session->set('email', $data['email']);
            $session->set('phone', $data['phone']);
            $session->set('location', $data['location']);
            
            $this->addFlash('success', 'Your account settings have been updated.');

            return $this->redirectToRoute('app_account_setting');
        }

        // Renderiza la plantilla con el formulario y datos de sesión
        return $this->render('modules/account_settings.html.twig', [
            'actual_page' => $actual_page,
            'user'        => $session->get('name'),
            'role'        => $session->get('role'),
            'status'      => $session->get('status'),
            'email'       => $session->get('email'),
            'phone'       => $session->get('phone'),
            'location'    => $session->get('location'),
            'accountForm' => $form->createView(),
        ]);
    }
}
