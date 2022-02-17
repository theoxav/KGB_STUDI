<?php

namespace App\DataFixtures;

use App\Entity\Target;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TargetsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // FIRST TARGET
        $target1 = new Target;
        $target1->setFirstName('Joe');
        $target1->setLastName('Kerr');
        $target1->setNationality('United-States');
        $target1->setAlias('The Joker');
        $target1->setBirthday(new \DateTimeImmutable());

        $manager->persist($target1);

        // SECOND TARGET
        $target2 = new Target;
        $target2->setFirstName('Boby');
        $target2->setLastName('Brown');
        $target2->setNationality('England');
        $target2->setAlias('The Torche');
        $target2->setBirthday(new \DateTimeImmutable());

        $manager->persist($target2);

        // THIRD TARGET
        $target3 = new Target;
        $target3->setFirstName('Jean');
        $target3->setLastName('Pierre');
        $target3->setNationality('France');
        $target3->setAlias('Magneto');
        $target3->setBirthday(new \DateTimeImmutable());

        $manager->persist($target3);
        
         
        $manager->flush();

   }

}
