<?php

namespace App\Controller;

use App\Form\CreateBlueprintType;
use App\Model\CustomSpaceship;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlueprintController extends AbstractController
{
    #[Route('/blueprint/create', name: 'app_blueprint_create')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateBlueprintType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // todo : handle form submission
            dd($form->getData());
        }

        return $this->render('blueprint/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('blueprint/create/classification-select', name: 'xhr_blueprint_classification_select')]
    public function getDependentClassificationSelect(Request $request)
    {
        // get manufacturer selected
        $model = new CustomSpaceship();
    }
}