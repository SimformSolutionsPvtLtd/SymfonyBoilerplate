<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\CountryCode;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];
        $builder
            ->add('email', EmailType::class, ['required' => true, 'label' => 'Email Address'])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_name' => 'passwordFirst',
                'second_name' => 'passwordSecond',
                'invalid_message' => 'Password not matched'))
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Name',
            ])
            ->add('countryCode', EntityType::class,[
                'multiple' => false, 'required' => false,
                'placeholder' => 'Choose Country code',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
