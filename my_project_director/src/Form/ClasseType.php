<?php

namespace App\Form;

use App\Entity\Cycle;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'required' => false, 
            'attr'=>[
                'placeholder'=>'Veuillez saisir le cycle','class'=> 'w-50 form-control my-1'],
                ])
            ->add('cycle_id', EntityType::class,[
                "class"=> Cycle::class,
                'attr'=>[
                    'class'=> 'w-50 form-control my-1'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
