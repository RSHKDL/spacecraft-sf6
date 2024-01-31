<?php

namespace App\Controller\Front;

use App\Entity\Manufacturer;
use App\Form\CreateCustomSpaceshipType;
use App\Repository\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    public function __construct(
        private readonly ManufacturerRepository $manufacturerRepository,
    ) {}

    #[Route('shop', name: 'shop_list')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreateCustomSpaceshipType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // todo : handle form submission
            dd($form->getData());
        }

        return $this->render(
            'shop/index.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }
}
