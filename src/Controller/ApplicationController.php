<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{

    private UserRepository|null $userRepository = null;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'rootRedirect')]
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute("app_login");
    }

    #[Route('/app/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $userProducts = $this->userRepository->find($this->getUser()->getUserIdentifier());

        return $this->render('application/dashboard.html.twig', [
            'user' => $this->getUser(),
            'userProducts' => $userProducts,
        ]);
    }

    #[Route('/app/browse', name: 'app_browse')]
    public function browse(): Response
    {
        return $this->render('application/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/app/settings', name: 'app_settings')]
    public function settings(): Response
    {
        return $this->render('application/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }


}
