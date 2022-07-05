<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Spaceship;
use App\Form\AddItemToCartType;
use App\Repository\SpaceshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    public function __construct(
        private readonly SpaceshipRepository $spaceshipRepository,
    ) {}

    #[Route('shop', name: 'app_shop_list')]
    public function index(): Response
    {
        return $this->render(
            'shop/index.html.twig', [
                'spaceships' => $this->spaceshipRepository->findAll(),
            ]
        );
    }

    #[Route('shop/{id}', name: 'app_shop_show')]
    public function show(Spaceship $spaceship, Request $request): Response
    {
        $form = $this->createForm(AddItemToCartType::class, null, [
            'spaceship' => $spaceship,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            /** @var CartItem $cartItem */
            $cartItem = $form->getData();
            /*$options = [];
            foreach ($optionTypes as $type) {
                $options[] = $form->get("option_{$type}")->getData();
            }
            $cartItem->setOptions($options);*/
            dd($cartItem);
        }

        return $this->render(
            'shop/show.html.twig', [
                'spaceship' => $spaceship,
                'form' => $form->createView()
            ]
        );
    }
}