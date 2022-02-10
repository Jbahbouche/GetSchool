<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            


            ->add('nom', TextType::class,[
                'required'=>false,
                'label'=>'Prenom',
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre nom','class'=> 'w-50 form-control my-1'
                ]
            ])
            ->add('prenom', TextType::class,[
                'required'=>false,
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre prénom','class'=> 'w-50 form-control my-1'
                ]
            ])
            ->add('email', EmailType::class, [
                'required'=>false,
                'label'=>"Email",
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre email','class'=> 'w-50 form-control my-1'
                ]
            ])
            ->add('coordonnees', TextType::class,[
                'required'=>false,
                'label'=>'Coordonnées',
                'attr'=>[
                    'placeholder'=>'Veuillez saisir vos Coordonnées', 'class'=> 'w-50 form-control'
                ]
            ])

            ->add('password', PasswordType::class,[
                'required'=>false,
                'label'=>'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Veuillez saisir votre mot de passe','class'=> 'w-50 form-control my-1'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
