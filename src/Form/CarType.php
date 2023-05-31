<?php

namespace App\Form;

use App\Entity\Car;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\Manufacturer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\CarOwnerType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name',
            ])
            ->add('color', TextType::class, [
                'required' => true,
                'label' => 'Enter Car color',
            ])
            ->add('chasisNumber', TextType::class, [
                'required' => true,
                'label' => 'Enter chasis number',
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'expanded' => false,
                'placeholder' => 'Choose',
                'choices' => array_flip(Car::carTypeChoices),
                'label' => 'Choose Car Type'
            ])
            ->add('manufacturer', EntityType::class,[
                'required' => false,
                'placeholder' => 'Choose',
                'class' => Manufacturer::class,
                'choice_label' => 'companyName'
            ])
            ->add('owner', CollectionType::class,
                [
                    'entry_type' => CarOwnerType::class,
                    'by_reference' => false,
                    'label' => false,
                    'prototype' => true,
                    'allow_delete' => true,
                    'allow_add' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
