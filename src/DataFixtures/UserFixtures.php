<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    use DataFixturesTrait;

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        try {
            $users = $this->loadData('users');
            foreach ($users as $userData) {
                $user = new User();
                $user->setEmail($userData['email']);
                $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
                $user->setFirstName($userData['firstName']);
                $user->setLastName($userData['lastName']);
                if ('admin' === $userData['role']) {
                    $user->setRoles(['ROLE_ADMIN']);
                }

                $manager->persist($user);
            }
            $manager->flush();
        } catch (\Throwable $throwable) {
            dd($throwable);
            // log exceptions...
        }
    }
}
