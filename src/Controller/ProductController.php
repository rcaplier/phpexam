<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'addNewProduct')]
    public function addNewProduct(): Response //TODO JSON RESPONSE
    {
        return $this->render('product/dashboard.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

}
