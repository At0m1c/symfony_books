<?php

namespace App\DataFixtures;

use App\Entity\Bill;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BillFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Damien Daugherty');
        $user->setLogin('Damien');
        $user->setEmail('bettye16@p-response.com');
        $manager->persist($user);

        $bill = new Bill();
        $bill->setUser($user);
        $bill->setAmount(25000);
        $manager->persist($bill);

        $manager->flush();
    }
}
