<?php

namespace App\Controller\Front;

use App\Spaceship\Factory\UsedSpaceshipFactory;
use App\Spaceship\GithubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedSpaceshipController extends AbstractController
{
    public function __construct(
        private readonly UsedSpaceshipFactory $usedSpaceshipFactory,
        private readonly GithubService $githubService
    ) {}

    #[Route('/spaceship/used', name: 'used_spaceship_index')]
    public function index(): Response
    {
        return $this->render('usedSpaceship/index.html.twig', [
            'usedSpaceships' => $this->createUsedSpaceships()
        ]);
    }

    #[Route('/spaceship/used/report/{spaceshipName}', name: 'used_spaceship_report')]
    public function askReport(string $spaceshipName): JsonResponse
    {
        $spaceshipName = ucfirst($spaceshipName);
        $report = $this->githubService->getConformityInspectionReport($spaceshipName);

        return $this->json($report->status?->value);
    }

    private function createUsedSpaceships(): \Generator
    {
        $builder = $this->usedSpaceshipFactory->createBuilder();

        yield $builder
            ->setName('Rocinante')
            ->setHullNumber('MRN000A22')
            ->setFullClassName('stealth corvette')
            ->buildUsedSpaceship();

        yield $builder
            ->setName('Serenity')
            ->setHullNumber('SRNT000042')
            ->setFullClassName('light frigate')
            ->buildUsedSpaceship();

        yield $builder
            ->setName('Galactica')
            ->setHullNumber('GLCTC00099')
            ->setFullClassName('battlestar')
            ->buildUsedSpaceship();
    }
}
