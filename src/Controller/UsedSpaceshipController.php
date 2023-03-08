<?php

namespace App\Controller;

use App\Spaceship\Factory\UsedSpaceshipFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedSpaceshipController extends AbstractController
{
    public function __construct(
        private readonly UsedSpaceshipFactory $usedSpaceshipFactory
    ) {}

    #[Route('/spaceship/used', name: 'app_used_spaceship_index')]
    public function index(): Response
    {
        return $this->render('usedSpaceship/index.html.twig', [
            'usedSpaceships' => $this->createUsedSpaceships()
        ]);
    }

    private function createUsedSpaceships(): \Generator
    {
        $builder = $this->usedSpaceshipFactory->createBuilder();

        yield $builder
            ->setName('Roccinante')
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