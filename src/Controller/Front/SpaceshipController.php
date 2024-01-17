<?php

namespace App\Controller\Front;

use App\Form\CreateCustomSpaceshipType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaceshipController extends AbstractController
{
    #[Route('/spaceship/create', name: 'spaceship_create')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateCustomSpaceshipType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // todo : handle form submission
            dd($form->getData());
        }

        return $this->render('spaceship/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
