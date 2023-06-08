<?php

namespace App\Form;

use App\Entity\Music;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr'=>[
                    'class' => 'form-control',
                    'style' => 'width: 40vh'
                    ]
                ])
            ->add('url', TextType::class, [
                'label' => 'URL',
                'attr'=>[
                    'class' => 'form-control',
                    'style' => 'width: 40vh'
                    ]
                ])
            ->add('user', TextType::class,[
                'attr'=>[
                    'label' => 'Nom',
                    'class' => 'form-control',
                    'style' => 'width: 10vh'
                    ]
                ])
            ->add('mood', EntityType::class, array(
                "class" => "App\Entity\Mood",
                'attr'=>[
                    'label' => 'Mood',
                    'class' => 'form-control',
                    'style' => 'width: 10vh'
                    ]
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Music::class,
        ]);
    }
}
