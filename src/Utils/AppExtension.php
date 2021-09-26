<?php

namespace App\Utils;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use JetBrains\PhpStorm\Pure;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    private ProductRepository|null $productRepository = null;
    private UserRepository|null $userRepository = null;

    /**
     * @param ProductRepository|null $productRepository
     * @param UserRepository|null $userRepository
     */
    public function __construct(?ProductRepository $productRepository, ?UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }


}