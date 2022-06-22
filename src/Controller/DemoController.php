<?php

namespace App\Controller;

use App\Form\AddItemToCartType;
use App\Repository\ProductOptionsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ProductOptionsRepository $productOptionsRepository,
    ) {}

    #[Route('demo', name: 'app_demo')]
    public function index(Request $request): Response
    {
        $product = $this->productRepository->findOneBy(['sku' => '000K99A271M']);
        $colors = $this->productOptionsRepository->findBy(['product' => $product, 'type' => 'color']);
        $form = $this->createForm(AddItemToCartType::class , null, [
            'product' => $product,
            'productOptions' => $colors,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            dd($form->getData());
        }

        return $this->render(
            'demo/index.html.twig', [
                'product' => $product,
                'colors' => $colors,
                'form' => $form->createView(),
            ]
        );
    }
}