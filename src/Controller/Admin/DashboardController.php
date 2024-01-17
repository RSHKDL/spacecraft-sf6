<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController
{
    #[Route('/', name: 'dashboard')]
    public function dashboard(): Response
    {
        return new Response('Todo: setup admin templates!');
    }
}
