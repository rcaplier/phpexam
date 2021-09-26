<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'rootRedirect')]
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute("app_login");
    }

    #[Route('/app/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/app/browse', name: 'app_browse')]
    public function browse(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/app/settings', name: 'app_settings')]
    public function settings(): Response
    {
        return $this->render('application/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }


}
