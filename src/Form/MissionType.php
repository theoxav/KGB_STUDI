<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Target;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\Mission;
use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('description',TextareaType::class)
            ->add('codeName',TextType::class)
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
            ->add('country',EntityType::class,[
                'choice_label' => 'country',
                'class' => Country::class,
                'multiple' => false
            ])
            ->add('skills',EntityType::class, [
                'choice_label' => 'name',
                'class' => Skill::class
            ])
            ->add('hideout', EntityType::class, [
                'choice_label' => fn(Hideout $hideout) => $hideout->getCode(). "(". $hideout->getCountry().")"
            ])
            ->add('agents', EntityType::class,[
                'choice_label' => fn(Agent $agent) => $agent->getCodeName(). "(".$agent->getNationality().")",
                'multiple' => true,
                'expanded' => true
            ])
            ->add('contacts',EntityType::class, [
                'choice_label' => fn(Contact $contact) => $contact->getAlias(). "(".$contact->getNationality().")",
                'mutliple' => true,
                'expanded' => true
            ])
            ->add('targets', EntityType::class,[
                'choice_label' => fn(Target $target) => $target->getAlias(). "(".$target->getNationality().")",
                'multiple' => true,
                'expanded' => true
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
