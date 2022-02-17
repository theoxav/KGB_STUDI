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
       $contact1->setNationality('France');
       $contact1->setAlias('The Mole');
       $contact1->setBirthday(new \DateTimeImmutable());
    
       $manager->persist($contact1);

        // SECOND CONTACT
      $contact2 = new Contact;
      $contact2->setFirstName('Kyle');
      $contact2->setLastName('Uper');
      $contact2->setNationality('United-States');
      $contact2->setAlias('L\'Americain');
      $contact2->setBirthday(new \DateTimeImmutable());

      $manager->persist($contact2);
      
     // THIRD CONTACT
     $contact3 = new Contact;
     $contact3->setFirstName('Will');
     $contact3->setLastName('Nothing');
     $contact3->setNationality('England');
     $contact3->setAlias('l\'Anglais');
     $contact3->setBirthday(new \DateTimeImmutable());

     $manager->persist($contact3);

     $manager->flush();

     // THIRD CONTACT
     $contact3 = new Contact;
     $contact3->setFirstName('Mike');
     $contact3->setLastName('Paris');
     $contact3->setNationality('France');
     $contact3->setAlias('Le Français');
     $contact3->setBirthday(new \DateTimeImmutable());

     $manager->persist($contact3);

     $manager->flush();
  }
}