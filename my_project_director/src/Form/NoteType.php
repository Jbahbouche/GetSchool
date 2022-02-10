<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score', IntegerType::class, [
                'required' => false, 
                'attr'=>[
                    'placeholder'=>'Veuillez saisir la note','class'=> 'w-50 form-control my-1', 'type' => 'integer'],
                    ])
            ->add('matiere',TextType::class, [
                'required' => false, 
                'attr'=>[
                    'placeholder'=>'Veuillez saisir la matière','class'=> 'w-50 form-control my-1'],
                    ])
            ->add('commentaire',TextType::class, [
                'required' => false, 
                'attr'=>[
                    'placeholder'=>'Veuillez saisir le commentaire','class'=> 'w-50 form-control my-1'],
                    ])
            
            ->add('etudiant_id', EntityType::class,[
                "class"=> User::class,
                'attr'=>[
                    'class'=> 'w-50 form-control my-1'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
