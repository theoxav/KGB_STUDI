<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AgentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $skill = new Skill;
        $skill->setName('fight');

        $manager->persist($skill);
        // AGENT 1
        $agent1 = new Agent();
        $agent1->setFirstName('James');
        $agent1->setLastName('Bond');
        $agent1->setBirthday(new \DateTimeImmutable());
        $agent1->setCodeName('007');
        $agent1->setNationality('England');
        $agent1->addSkill($skill);


        $manager->persist($agent1);
        $manager->flush();

         // AGENT 2
         $agent2 = new Agent();
         $agent2->setFirstName('Steve');
         $agent2->setLastName('Rogers');
         $agent2->setBirthday(new \DateTimeImmutable());
         $agent2->setCodeName('Captain America');
         $agent2->setNationality('United-States');
         $agent2->addSkill($skill);
 
         $manager->persist($agent2);
         $manager->flush();

         // AGENT 3
         $agent3 = new Agent();
         $agent3->setFirstName('Kakarot');
         $agent3->setLastName('Goku');
         $agent3->setBirthday(new \DateTimeImmutable());
         $agent3->setCodeName('SanGoku');
         $agent3->setNationality('Japan');
         $agent3->addSkill($skill);
 
         $manager->persist($agent3);
         $manager->flush();

         // AGENT 4
         $agent4 = new Agent();
         $agent4->setFirstName('Hugh');
         $agent4->setLastName('Jackman');
         $agent4->setBirthday(new \DateTimeImmutable());
         $agent4->setCodeName('Wolverine');
         $agent4->setNationality('France');
         $agent4->addSkill($skill);
 
         $manager->persist($agent4);
         $manager->flush();

         // AGENT 5
         $agent5 = new Agent();
         $agent5->setFirstName('John');
         $agent5->setLastName('Doe');
         $agent5->setBirthday(new \DateTimeImmutable());
         $agent5->setCodeName('008');
         $agent5->setNationality('France');
         $agent5->addSkill($skill);
 
         $manager->persist($agent5);
         $manager->flush();
    }
}
