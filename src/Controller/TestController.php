<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('test', name: 'app_test')]
    public function test(): Response
    {
        return new Response('ok, symfony 6 is setup');
    }
}