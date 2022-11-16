<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    #[Route('/logon', name: 'logon')]
    public function logon(): Response
    {
      /*   return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]); */
        return $this->redirectToRoute('app_accueil');
    }
}
