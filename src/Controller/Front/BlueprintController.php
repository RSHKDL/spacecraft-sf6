<?php

namespace App\Controller\Front;

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

    #[Route('/blueprint/create', name: 'blueprint_create')]
    public function create(Request $request, BlueprintRepository $repository): Response
    {
        // todo Opquast rule 84
        return $this->render('blueprint/stepIntro.html.twig');
    }

    #[Route('/blueprint/step/hull', name: 'blueprint_step_hull')]
    public function selectHull(Request $request, BlueprintRepository $repository): Response
    {
         // todo refacto Blueprint to Hull and use Blueprint as an order
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
            $blueprint = $form->getData();
            return $this->redirectToRoute('app_blueprint_step_components');
        }

        return $this->render('blueprint/stepHull.html.twig', [
            'form' => $form->createView(),
            'blueprints' => $blueprintsAsJson,
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
