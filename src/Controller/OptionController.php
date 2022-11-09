<?php

namespace App\Controller;

use App\Repository\BaseOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptionController extends AbstractController
{
    #[Route('/spaceship/options', name: 'app_options_list')]
    public function index(BaseOptionRepository $optionRepository): Response
    {
        return $this->render('spaceshipOptions/index.html.twig', [
            'options' => $optionRepository->findAll()
        ]);
    }
}