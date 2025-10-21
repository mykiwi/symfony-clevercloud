<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('ok@ok.ok');
        $user->setPassword('$2y$13$8pupPI5cwcMoXU3WCz4GgOEPmCEvWI.4XGNscB3x82q6khVmT5hzy'); # ok@ok.ok

        $manager->persist($user);

        $manager->flush();
    }
}
