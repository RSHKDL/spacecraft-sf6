<?php

namespace App\Controller\Front;

use App\Entity\MilitaryClassification;
use App\Form\CreateHullType;
use App\Model\CustomSpaceship;
use App\Repository\MilitaryClassificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

// todo rename
class BlueprintController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {}

    #[Route('/blueprint/create', name: 'blueprint_create')]
    public function create(Request $request): Response
    {
        // todo Opquast rule 84
        return $this->render('blueprint/stepIntro.html.twig');
    }

    #[Route('/blueprint/step/hull', name: 'blueprint_step_hull')]
    public function selectHull(Request $request, MilitaryClassificationRepository $repository): Response
    {
         // todo refacto Blueprint to Hull and use Blueprint as an order (when SpaceshipBuilder is functional)
        $form = $this->createForm(CreateHullType::class);
        $militaryClassification = $repository->findAll();

        $hullsAsJson = $this->serializer->serialize(
            $this->transformMilitaryClassificationCollection($militaryClassification), 'json'
        );

        $hullsAsJsonDebug = $this->serializer->serialize(
            $this->transformMilitaryClassificationCollection($militaryClassification),
            'json',
            ['json_encode_options' => \JSON_PRETTY_PRINT]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hull = $form->getData();
            // todo handle hull and order
            dd($hull);

            return $this->redirectToRoute('app_blueprint_step_components');
        }

        return $this->render('blueprint/stepHull.html.twig', [
            'form' => $form->createView(),
            'hull' => $hullsAsJson,
            'debug' => $hullsAsJsonDebug,
        ]);
    }

    #[Route('/blueprint/step/components', name: 'blueprint_step_components')]
    public function selectComponents(): Response
    {
        return $this->render('blueprint/stepComponents.html.twig');
    }

    #[Route('blueprint/create/classification-select', name: 'blueprint_classification_select_xhr')]
    public function getDependentClassificationSelect(Request $request)
    {
        // get manufacturer selected
        $model = new CustomSpaceship();
    }

    private function transformMilitaryClassificationCollection(array $classifications): array
    {
        $newCollection = [];
        foreach ($classifications as $classification) {
            $newCollection[] = $this->transformMilitaryClassification($classification);
        }

        return $newCollection;
    }

    // todo remove when transformMilitaryClassification works
    private function transformBlueprint(Blueprint $blueprint): array
    {
        return [
            'blueprintId' => $blueprint->getId(),
            'manufacturerId' => $blueprint->getManufacturer()->getId(),
            'manufacturerName' => $blueprint->getManufacturer()->getName(),
            'roleId' => $blueprint->getRole()->getId(),
            'roleName' => $blueprint->getRole()->getName(),
            'classId' => $blueprint->getClass()->getId(),
            'className' => mb_strtolower($blueprint->getClass()->getName()),
            'classVariant' => $blueprint->getClass()->getVariant()
        ];
    }

    // todo see somethingId and somethingName in the json refacto, cf. select-blueprints_controller.js
    private function transformMilitaryClassification(MilitaryClassification $classification): array
    {
        return [
            'classificationId' => $classification->getId(),
            'classId' => $classification->getName(),
            'className' => $classification->getName(),
            'classVariant' => $classification->getVariant(),
            'manufacturerId' => 'todo',
            'manufacturerName' => 'todo',
            'roleId' => 'military',
            'roleName' => 'military',
        ];
    }
}
