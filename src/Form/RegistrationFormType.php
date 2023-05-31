<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class, ['required' => true, 'label' => 'Email Address'])
        ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_name' => 'passwordFirst',
            'second_name' => 'passwordSecond',
            'invalid_message' => 'Password not matched'))
        ->add('name', TextType::class, [
            'required' => true,
            'constraints' => new NotBlank(),
            'label' => 'Name',
        ])
        ->add('countryCode', EntityType::class,[
            'multiple' => false, 'required' => false,
            'placeholder' => '91',
            'class' => CountryCode::class,
            'choice_label' => 'code',
            'query_builder' => function (EntityRepository $er) {
                return $er->getAll();
            }])
        ->add('contactNumber', TextType::class, ['label' => 'Phone'])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least 6 characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
