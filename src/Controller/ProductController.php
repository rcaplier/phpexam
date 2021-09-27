<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{

    private ProductRepository|null $productRepository = null;
    private UserRepository|null $userRepository = null;
    private SerializerInterface|null $serializer = null;

    /**
     * @param ProductRepository|null $productRepository
     * @param UserRepository|null $userRepository
     * @param SerializerInterface|null $serializer
     */
    public function __construct(?ProductRepository $productRepository, ?UserRepository $userRepository, ?SerializerInterface $serializer)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    /**
     * @param int $page
     * @return JsonResponse
     */
    #[Route('/onSellProducts/{page}', name: 'onSellProductsWithPagination', methods: 'GET')]
    public function onSellProducts(int $page): JsonResponse
    {
        $page = $page * 20 - 20;
        $products = $this->productRepository->findBy(['onSell' => true], null, 20, $page);
        $products = $this->serializer->serialize($products, "json", [
            AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true,
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['password', 'roles'],
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            }
        ]);

        return new JsonResponse($products, 200, [], true);
    }

    /**
     * @param string $userEmail
     * @return JsonResponse
     */
    #[Route('/onSellProductsByUser/{userEmail}', name: 'onSellProductsByUserEmail', methods: 'GET')]
    public function onSellProductsByUser(string $userEmail): JsonResponse
    {
        $user = $this->userRepository->findBy(['email' => $userEmail]);
        $products = $this->productRepository->findBy(['owner' => $user]);
        $products = $this->serializer->serialize($products, "json", [
            AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true,
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['password', 'roles'],
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            }
        ]);

        return new JsonResponse($products, 200, [], true);
    }

}
