<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr'=>[
                    'class' => 'form-control'
                    ]
                ])
            ->add('subject', TextType::class, [
                'label' => 'Title',
                'attr'=>[
                    'class' => 'form-control'
                ]
            ])
            ->add('content' , TextareaType::class, [
                'label' => 'Contenu',
                'attr'=>[
                    'class' => 'form-control',
                    'style' => 'height: 200px'
                ]
            ])
            ->add('confirm' , SubmitType::class, [
                'label' => 'Envoyer',
                'attr'=>[
                    'class' => 'btn btn-dark mt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
