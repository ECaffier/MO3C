<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'formInput',
                ],
                'label' => 'Nom d\'utilisateur',
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'formInput',
                ],
                'label' => 'Mot de passe'
            ])
            ->add('login', SubmitType::class, [
                'attr' => [
                    'class' => 'submitButton'
                ],
                'label' => 'Connexion'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
