<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('reception_id', EntityType::class, [
            "class" => User::class,
            "choice_label" =>"email",
            "attr" => [
                "class" =>"form-control"
            ]
        ])

        ->add('created_at', DateType::class, [
            'widget' => 'choice',
            'input'  => 'datetime_immutable'
        ])
        
        
        ->add('title', TextType::class, [
            "attr" => [
                "class" => "form-control"
            ]
        ])
        ->add('texte', TextareaType::class, [
            "attr" => [
                "class" => "form-control my-2"
            ]
        ])
        
        ->add('envoyer', SubmitType::class, [
            "attr" => [
                "class" => "btn btn-primary"
            ]
        ])
        // ->add('envoi_id', SubmitType::class, [
        //     "attr" => [
        //         "class" => "btn btn-primary"
        //     ]
        //  ])
            // ->add('texte', TextareaType::class, [
            //     "attr" => [
            //         "class" => "form-control"
            //     ]
            // ])
            // // ->add('created_at')
            //  ->add('envoi_id', SubmitType::class, [
            //     "attr" => [
            //         "class" => "btn btn-primary"
            //     ]
            //  ])
            // ->add('reception_id', EntityType::class, [
            //     "class" => User::class,
            //     "choice_label" =>"email",
            //     "attr" => [
            //         "class" =>"form-control"
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
