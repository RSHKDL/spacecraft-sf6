<?php

namespace App\Controller;

use App\Repository\BaseComponentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComponentController extends AbstractController
{
    private const COMPONENTS_PER_PAGE = 10;

    #[Route('/spaceship/components/{page}', name: 'app_component_index')]
    public function index(BaseComponentRepository $optionRepository, int $page = 1): Response
    {
        $paginatedComponents = $optionRepository->findAllPaginated($page, self::COMPONENTS_PER_PAGE);
        $totalComponents = $paginatedComponents->count();

        return $this->render('spaceshipComponents/index.html.twig', [
            'options' => $paginatedComponents,
            'totalComponents' => $totalComponents,
            'totalPage' => (int) ceil($totalComponents / self::COMPONENTS_PER_PAGE),
            'currentPage' => $page
        ]);
    }
}
