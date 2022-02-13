<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SkillsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $skills1 = new Skill;
        $skills1->setName('Kung-fu');
 
        $manager->persist($skills1);

        $skills2 = new Skill;
        $skills2->setName('precision');

        $manager->persist($skills2);

        $skills3 = new Skill;
        $skills3->setName('invisibility');

        $manager->persist($skills2);

        $skills4 = new Skill;
        $skills4->setName('Speed');

        $manager->persist($skills4);

        $skills5 = new Skill;
        $skills5->setName('Thai-Shi');

        $manager->persist($skills5);

        $skills6 = new Skill;
        $skills6->setName('Thief');

        $manager->persist($skills6);

        $skills7 = new Skill;
        $skills7->setName('Strength');

        $manager->persist($skills7);

        $manager->flush();
    }
}
