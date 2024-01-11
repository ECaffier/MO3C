<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'formInput',
                    'minlength' => '2',
                    'maxlength' => '80',
                ],
                'label' => 'Nom et Prénom',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50])
                ] 
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'formInput',
                    'maxlength' => '50',
                ],
                'label' => 'Adresse email*',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' => 2, 'max' => 50])
                ] 
            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'class' => 'formInput',
                    'maxlength' => '120',
                ],
                'label' => 'Sujet*',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50])
                ] 
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'formInput',
                ],
                'label' => 'Message*',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 20])
                ] 
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submitButton'
                ],
                'label' => 'Soumettre',
            ])

            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'contact'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'task_item',
        ]);
    }
}
