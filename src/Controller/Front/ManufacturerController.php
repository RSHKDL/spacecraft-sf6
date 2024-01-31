<?php

namespace App\Controller\Front;

use App\Entity\Manufacturer;
use App\Form\CreateCustomSpaceshipType;
use App\Manufacturer\Factory\ManufacturerFactory;
use App\Repository\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManufacturerController extends AbstractController
{
    public function __construct(
        private readonly ManufacturerRepository $manufacturerRepository,
    ) {}

    #[Route('manufacturer', name: 'manufacturer_list')]
    public function index(Request $request): Response
    {
        $searchTerm = $request->query->get('q');
        $manufacturers = $this->manufacturerRepository->search($searchTerm);

        if ($request->query->get('preview')) {
            return $this->render('manufacturer/_searchPreview.html.twig', [
                'manufacturers' => $manufacturers,
            ]);
        }

        return $this->render('manufacturer/index.html.twig', [
            'manufacturers' => $manufacturers,
            'searchTerm' => $searchTerm,
        ]);
    }

    #[Route('manufacturer/{slug}', name: 'manufacturer_show')]
    public function show(Manufacturer $manufacturer, Request $request): Response
    {
        $searchTerm = $request->query->get('q');
        $manufacturers = $this->manufacturerRepository->search($searchTerm);

        if ($request->query->get('preview')) {
            return $this->render('manufacturer/_searchPreview.html.twig', [
                'manufacturers' => $manufacturers,
            ]);
        }

        return $this->render('manufacturer/show.html.twig', [
            'manufacturer' => $manufacturer,
            'manufacturers' => $manufacturers,
            'searchTerm' => $searchTerm,
        ]);
    }
}
