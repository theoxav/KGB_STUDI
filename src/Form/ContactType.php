<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName',TextType::class)
        ->add('lastName',TextType::class)
        ->add('birthday',BirthdayType::class)
        ->add('nationality',TextType::class)
        ->add('alias',TextType::class,[
            'constraints' => [
                new NotBlank(['message'=> 'Please enter a code name.'])
            ]
            ])
        ->add('imageFile',VichImageType::class,[
            'label' => 'Image (JPG or PNG file)',
            'required' => false,
            'download_uri' => false,
            'imagine_pattern' => 'squared_thumbnail_small'
        ]) 
         
            ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
