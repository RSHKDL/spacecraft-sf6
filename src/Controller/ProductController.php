<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\AddItemToCartType;
use App\Repository\ProductOptionsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(Product $product, Request $request): Response
    {
        $optionTypes = $this->productRepository->getDistinctOptionTypeByProduct($product);

        $form = $this->createForm(AddItemToCartType::class, null, [
            'product' => $product,
            'optionsTypes' => $optionTypes
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            /** @var CartItem $cartItem */
            $cartItem = $form->getData();
            $options = [];
            foreach ($optionTypes as $type) {
                $options[] = $form->get("option_{$type}")->getData();
            }
            $cartItem->setOptions($options);
            dd($cartItem);
        }

        return $this->render(
            'product/show.html.twig', [
                'product' => $product,
                'form' => $form->createView()
            ]
        );
    }
}