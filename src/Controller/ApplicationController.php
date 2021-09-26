<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddProductType;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{

    private UserRepository|null $userRepository = null;
    private ProductRepository|null $productRepository = null;
    private EntityManagerInterface|null $entityManager = null;

    public function __construct(UserRepository $userRepository,ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
    }

    #[Route('/', name: 'rootRedirect')]
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute("app_login");
    }


    #[Route('/app/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $user = $this->userRepository->find($this->getUser());
        $userProducts = $this->productRepository->findBy([
            "owner" => $user,
        ]);

        return $this->render('application/dashboard.html.twig', [
            'user' => $this->getUser(),
            'userProducts' => $userProducts,
        ]);
    }


    #[Route('/app/add_product', name: 'app_add_product')]
    public function addProductView(): Response
    {
        $product = new Product();
        $addProductForm = $this->createForm(AddProductType::class, $product, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_add_product_handler')]);
        return $this->render('application/add_product.html.twig', [
            'addProductForm' => $addProductForm->createView(),
        ]);
    }

    #[Route('/app/add_product_handler', name: 'app_add_product_handler')]
    public function addProduct(Request $request): Response
    {
        $product = new Product();
        $user = $this->userRepository->find($this->getUser());
        $addProductForm = $this->createForm(AddProductType::class, $product);
        $addProductForm->handleRequest($request);

        if ($addProductForm->isSubmitted() && $addProductForm->isValid()) {
            $imgFile = $addProductForm->get("imgUrl")->getData();
            if ($imgFile){
                $newFilename = uniqid() . '.' . $imgFile->guessExtension();
                try {
                    if ($imgFile->move($this->getParameter('img_directory'), $newFilename)) {
                        $product->setImgUrl($newFilename);
                    }
                } catch (FileException $e) {
                    dd($e);
                }
            }
            $product->setCreatedAt(new DateTime());
            $product->setOwner($user);
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        } else {
            dd($addProductForm);
        }
        return $this->redirectToRoute("app_dashboard");
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
