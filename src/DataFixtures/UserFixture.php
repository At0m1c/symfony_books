<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Lorenz Douglas');
        $user->setLogin('Lorenz');
        $user->setEmail('meagan08@gogreenon.com');
        $manager->persist($user);

        $manager->flush();
    }
}
