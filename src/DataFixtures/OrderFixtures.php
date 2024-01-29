<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    use DataFixturesTrait;

    public function load(ObjectManager $manager): void
    {
        try {
            $data = $this->loadData("orders");
            foreach ($data as $datum) {
                $order = new Order();
                $statuses = $datum['status'];
                foreach ($statuses as $statusDatum) {
                    $status = new OrderStatus($statusDatum['code']);
                    $date = new \DateTimeImmutable($statusDatum['date']);
                    $status->setDate($date);
                    $status->setOrder($order);
                    $order->addStatus($status);
                }

                $manager->persist($order);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}
