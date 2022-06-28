<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductOptionsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ProductOptionsRepository $productOptionsRepository,
    ) {}

    #[Route('shop', name: 'app_product_list')]
    public function index(): Response
    {
        return $this->render(
            'product/index.html.twig', [
                'products' => $this->productRepository->findAll(),
            ]
        );
    }

    #[Route('shop/{id}', name: 'app_product_show')]
    public function show(Product $product): Response
    {
        return $this->render(
            'product/show.html.twig', [
                'product' => $product,
            ]
        );
    }
}