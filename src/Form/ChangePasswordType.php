<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre nom :',
                'disabled' => true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom :',  'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'mapped' => false
            ])
            ->add('new_password',RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'label' => 'Votre nouveau mot de passe',
                'invalid_message' => 'Le mot de passe et la confirmaion doivent etre identique',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de Passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre new mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre mot de passe'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' =>  "Mettre a jour "
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
