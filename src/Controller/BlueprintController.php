<?php

namespace App\Controller;

use App\Entity\Blueprint;
use App\Form\CreateBlueprintType;
use App\Model\CustomSpaceship;
use App\Repository\BlueprintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BlueprintController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {}

    #[Route('/blueprint/create', name: 'app_blueprint_create')]
    public function create(Request $request, BlueprintRepository $repository): Response
    {
        $form = $this->createForm(CreateBlueprintType::class);
        $blueprints = $repository->findAll();

        $blueprintsAsJson = $this->serializer->serialize($this->transformBlueprintCollection($blueprints), 'json');

        $blueprintsAsJsonDebug = $this->serializer->serialize(
            $this->transformBlueprintCollection($blueprints),
            'json',
            ['json_encode_options' => \JSON_PRETTY_PRINT]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // todo : handle form submission
            dd($form->getData());
        }

        return $this->render('blueprint/create.html.twig', [
            'form' => $form->createView(),
            'blueprints' => $blueprintsAsJson,
            'blueprintsDebug' => $blueprintsAsJsonDebug
        ]);
    }

    #[Route('blueprint/create/classification-select', name: 'xhr_blueprint_classification_select')]
    public function getDependentClassificationSelect(Request $request)
    {
        // get manufacturer selected
        $model = new CustomSpaceship();
    }

    private function transformBlueprintCollection(array $blueprints): array
    {
        $newCollection = [];
        foreach ($blueprints as $blueprint) {
            $newCollection[] = $this->transformBlueprint($blueprint);
        }

        return $newCollection;
    }
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
}