<?php

namespace App\Controller;

use App\Form\CreateCustomSpaceshipType;
use App\Model\CustomSpaceship;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaceshipController extends AbstractController
{
    #[Route('/spaceship/create', name: 'app_spaceship_create')]
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

    #[Route('spaceship/create/classification-select', name: 'xhr_spaceship_classification_select')]
    public function getDependentClassificationSelect(Request $request)
    {
        // get manufacturer selected
        $model = new CustomSpaceship();
    }
}