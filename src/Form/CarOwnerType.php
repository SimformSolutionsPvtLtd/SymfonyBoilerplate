<?php

namespace App\Form;

use App\Entity\CarOwner;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CarOwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name',
                'constraints' => new Assert\NotBlank()
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Enter Email',
                'constraints' => new Assert\NotBlank()
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label' => 'Enter city name',
                'constraints' => new Assert\NotBlank()
            ])
            ->add('state', TextType::class, [
                'required' => true,
                'label' => 'Enter state name',
                'constraints' => new Assert\NotBlank()
            ])
            ->add('country', TextType::class, [
                'required' => true,
                'label' => 'Enter country name',
                'constraints' => new Assert\NotBlank()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CarOwner::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'car_owner_type';
    }
}
