<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\MissionGender;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MissionsGenderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type1 = new MissionGender;
        $type1->setName('Infiltration');

        $manager->persist($type1);

        $type2 = new MissionGender;
        $type2->setName('Assassination');

        $manager->persist($type2);

        $type3 = new MissionGender;
        $type3->setName('Monitoring');

        $manager->persist($type3);


        $type4 = new MissionGender;
        $type4->setName('Protection');

        $manager->persist($type4);

         $manager->flush();
    }
}
