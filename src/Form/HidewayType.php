<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Hideout;
use App\Entity\HideoutType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HidewayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code',TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('address', TextType::class,[
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('country', EntityType::class, [
                'choice_label' => 'name',
                'class' => Country::class,
                'multiple' => false,
              
            ])
            ->add('type', EntityType::class, [
                'choice_label' => 'name',
                'class' => HideoutType::class,
                'multiple' => false,
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hideout::class,
        ]);
    }
}
