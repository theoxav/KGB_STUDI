<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Skill;
use App\Entity\Target;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\Mission;
use App\Entity\MissionGender;
use Doctrine\DBAL\Types\ArrayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)

            ->add('codeName',TextType::class)

            ->add('description',TextareaType::class)

            ->add('country',EntityType::class,[
                'choice_label' => 'name',
                'class' => Country::class,
                'multiple' => false
            ])

            ->add('hideout', EntityType::class, [
                'choice_label' => fn($hideout) => $hideout->getAddress()." (".$hideout->getCountry()->getName().")",
                'class' => Hideout::class
            ])

            ->add('mission_gender',EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Mission Type',
                'class' => MissionGender::class
            ])

            ->add('skills',EntityType::class, [
                'choice_label' => 'name',
                'class' => Skill::class
            ])

             
            ->add('agents', EntityType::class,[
                'choice_label' => fn($agent) => $agent->getCodeName()." (".$agent->getNationality().")",
                'class' => Agent::class,
                'multiple' => true,
                'expanded' => true
            ])

            ->add('contacts',EntityType::class, [
                'choice_label' => fn($contact) => $contact->getAlias()." (".$contact->getNationality().")",
                'class' => Contact::class,
                'multiple' => true,
                'expanded' => true
            ])

            ->add('targets', EntityType::class,[
                'choice_label' => fn(Target $target) => $target->getAlias(). " (".$target->getNationality().")",
                'class' => Target::class,
                'multiple' => true,
                'expanded' => true
            ])

            ->add('status', ChoiceType::class, [
        
                'choices' => [
                  'Preparation'=> 'preparation',
                  'Started' => 'started',
                  'finished' => 'finished',
                  'failed' => 'failed',
                ]
            ])

            ->add('startDate',DateType::class, [
                'widget' => 'choice',
                'format' => 'y-M-d',
                'years' => range(date("Y"),2030)
            ])
            ->add('endDate',DateType::class, [
                'widget' => 'choice',
                'format' => 'y-M-d',
                'years' => range(date("Y"),2030)
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
