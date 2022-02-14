<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\HideoutType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HideoutsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //HIDEOUT 1
        $hideout1 = new Hideout;
        $hideout1->setCode('Red');
        $hideout1->setAddress('16 rue des Coudriers Paris');
        
        $building = new HideoutType();
        $building->setName('Building');

        $france = new Country;
        $france->setName('France');

        $hideout1->setType($building);
        $hideout1->setCountry($france);
       
        $manager->persist($hideout1,$building,$france);
        

        // HIDEOUT 2
        $hideout2 = new Hideout;
        $hideout2->setCode('Dark');
        $hideout2->setAddress('Jenaer Strasse 82 Mulheim');
        
        $house = new HideoutType();
        $house->setName('House');

        $germany = new Country;
        $germany->setName('Germany');

        $hideout2->setType($house);
        $hideout2->setCountry($germany);
       
        $manager->persist($hideout2,$building,$germany);

        // HIDEOUT 3
        $hideout3 = new Hideout;
        $hideout3->setCode('Blue');
        $hideout3->setAddress('3660 Patterson Street Houston');
        
        $villa = new HideoutType();
        $villa->setName('Villa');

        $unitedStates = new Country;
        $unitedStates->setName('United-States');

        $hideout3->setType($villa);
        $hideout3->setCountry($unitedStates);
    
        $manager->persist($hideout3,$villa,$germany);
        
        $manager->flush();
     
    }

  
}
