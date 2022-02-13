<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       // FIRST CONTACT
       $contact1 = new Contact;
       $contact1->setFirstName('Jean');
       $contact1->setLastName('Mark');
       $contact1->setNationality('French');
       $contact1->setAlias('The Mole');
       $contact1->setBirthday(new \DateTimeImmutable());
    
       $manager->persist($contact1);

        // SECOND CONTACT
      $contact2 = new Contact;
      $contact2->setFirstName('Kyle');
      $contact2->setLastName('Uper');
      $contact2->setNationality('America');
      $contact2->setAlias('The Balance');
      $contact2->setBirthday(new \DateTimeImmutable());

      $manager->persist($contact2);
      
     // THIRD CONTACT
     $contact3 = new Contact;
     $contact3->setFirstName('John');
     $contact3->setLastName('Doe');
     $contact3->setNationality('English');
     $contact3->setAlias('Hanging Tongue');
     $contact3->setBirthday(new \DateTimeImmutable());

     $manager->persist($contact3);

     $manager->flush();
  }
}