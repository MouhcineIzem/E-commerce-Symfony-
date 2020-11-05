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

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name : ',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prenom'
                ]
            ])
            ->add('lastName', TextType::class,[
                'label' => 'Last Name : ',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : ',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email'
                ]
            ])
            ->add('password',RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => 'Votre mot de passe',
                'invalid_message' => 'Le mot de passe et la confirmaion doivent etre identique',
                'required' => true,
                'first_options' => ['label' => 'Mot de Passe'],
                'second_options' => ['label' => 'Confirmer Mot de passe']
            ])
            ->add('submit', SubmitType::class,[
                'label' =>  "S'inscrire"
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
