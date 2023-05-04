<?php

namespace App\Controller;

use App\Repository\BaseOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptionController extends AbstractController
{
    private const COMPONENTS_PER_PAGE = 3;

    #[Route('/spaceship/options/{page}', name: 'app_options_list')]
    public function index(BaseOptionRepository $optionRepository, int $page = 1): Response
    {
        $paginatedComponents = $optionRepository->findAllPaginated($page, self::COMPONENTS_PER_PAGE);
        $totalComponents = $paginatedComponents->count();

        return $this->render('spaceshipOptions/index.html.twig', [
            'options' => $paginatedComponents,
            'totalComponents' => $totalComponents,
            'totalPage' => (int) ceil($totalComponents / self::COMPONENTS_PER_PAGE),
            'currentPage' => $page
        ]);
    }
}
