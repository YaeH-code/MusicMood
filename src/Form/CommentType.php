<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user')
            ->add('music')
            //     ->add('mood', EntityType::class, array(
            //         "class" => "App\Entity\Mood",
            //         'attr'=>[
            //             'label' => 'Mood',
            //             'class' => 'form-control',
            //             'style' => 'width: 10vh'
            //             ]
            // ))
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr'=>[
                    'class' => 'form-control',
                    'style' => 'height: 100px'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
