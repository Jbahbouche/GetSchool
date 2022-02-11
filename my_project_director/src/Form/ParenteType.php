<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Parente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enfant',EntityType::class,[
                "class"=> User::class,
                'attr'=>[
                    'class'=> 'w-50 form-control my-1'],
        ]
            )
            ->add('parent',EntityType::class,[
                "class"=> User::class,
                'attr'=>[
                    'class'=> 'w-50 form-control my-1'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parente::class,
        ]);
    }
}
