<?php

namespace App\Controller\Admin;

use App\Repository\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ManufacturerController extends AbstractController
{
    public function __construct(
        private readonly ManufacturerRepository $manufacturerRepository,
    ) {
    }

    #[Route('manufacturer', name: 'manufacturer_list')]
    public function index(): Response
    {
        return $this->render('admin/manufacturer/index.html.twig', [
            'manufacturers' => $this->manufacturerRepository->findAll(),
        ]);
    }
}
