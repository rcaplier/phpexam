<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/app/add_product', name: 'app_add_product')]
    public function addProductView(): Response
    {
        return $this->render('product/dashboard.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

}
