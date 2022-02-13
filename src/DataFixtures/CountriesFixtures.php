<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CountriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $algeria = new Country;
        $algeria->setName('Algeria');
 
        $manager->persist($algeria);

        $egypt = new Country;
        $egypt->setName('Egypt');

        $manager->persist($egypt);

        $senegal = new Country;
        $senegal->setName('Senegal');

        $manager->persist($senegal);

        $tanzanie = new Country;
        $tanzanie->setName('Tanzanie');

        $manager->persist($tanzanie);

        $armenia = new Country;
        $armenia->setName('Armenia');

        $manager->persist($armenia);

        $belgium = new Country;
        $belgium->setName('Belgium');

        $manager->persist($belgium);

        $croatia = new Country;
        $croatia->setName('Croatia');

        $manager->persist($croatia);


        $denmark = new Country;
        $denmark->setName('Denmark');

        $manager->persist($denmark);


        $finland = new Country;
        $finland->setName('Finland');

        $manager->persist($finland);


        $france = new Country;
        $france->setName('France');

        $manager->persist($france);


        $germany = new Country;
        $germany->setName('Germany');

        $manager->persist($germany);

        $greece = new Country;
        $greece->setName('Greece');

        $manager->persist($greece);

        $iceland = new Country;
        $iceland->setName('Iceland');

        $manager->persist($iceland);

        $italy = new Country;
        $italy->setName('Italy');

        $manager->persist($italy);

        $norway = new Country;
        $norway->setName('Norway');

        $manager->persist($norway);

        $spain = new Country;
        $spain->setName('Spain');

        $manager->persist($spain);

        $unitedKingdom = new Country;
        $unitedKingdom->setName('United-Kingdom');

        $manager->persist($unitedKingdom);

        $canada = new Country;
        $canada->setName('Canada');

        $manager->persist($canada);

        $mexico = new Country;
        $mexico->setName('Mexico');

        $manager->persist($mexico);

        $brazil = new Country;
        $brazil->setName('Brazil');

        $manager->persist($brazil);

        $afghanistan = new Country;
        $afghanistan->setName('Afghanistan');

        $manager->persist($afghanistan);

        $china = new Country;
        $china->setName('China');

        $manager->persist($china);

        $india = new Country;
        $india->setName('India');

        $manager->persist($india);

        $japan = new Country;
        $japan->setName('Japan');

        $manager->persist($japan);

        $manager->flush();

        $russian = new Country;
        $russian->setName('Russian');

        $manager->persist($russian);

        $australia = new Country;
        $australia->setName('Australia');

        $manager->persist($australia);

        $newZealand = new Country;
        $newZealand->setName('New-Zeland');

        $manager->persist($newZealand);

        $unitedStates = new Country;
        $unitedStates->setName('United-States');

        $manager->persist($unitedStates);
    }
}
