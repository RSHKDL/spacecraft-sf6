<?php

namespace App\Controller;

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

    #[Route('shop', name: 'app_shop_list')]
    public function index(): Response
    {
        return $this->render(
            'shop/index.html.twig', [
                'manufacturers' => $this->manufacturerRepository->findAll()
            ]
        );
    }

    #[Route('shop/{id}', name: 'app_shop_show')]
    public function show(Manufacturer $manufacturer, Request $request): Response
    {
        $form = $this->createForm(CreateCustomSpaceshipType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // todo : handle form submission
        }

        return $this->render(
            'shop/show.html.twig', [
                'manufacturer' => $manufacturer,
                'form' => $form->createView()
            ]
        );
    }
}