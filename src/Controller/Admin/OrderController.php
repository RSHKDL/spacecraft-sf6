<?php

namespace App\Controller\Admin;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/orders', name: 'order_list')]
    public function index(OrderRepository $repository): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'orders' => $repository->findAll(),
            'ordersAvailableForTracking' => $repository->findOrdersAvailableForTracking(),
        ]);
    }
}
