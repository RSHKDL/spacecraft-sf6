<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/used-spaceships', name: 'api_used_spaceship')]
class MockUsedSpaceshipApiController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->json('I am a JSON response');
    }
}