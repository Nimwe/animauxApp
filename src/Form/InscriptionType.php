<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('roles', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                'style' => 'margin:5px 0;'),
                'choices' => 
                array
                (
                    'ROLE_ADMIN' => array
                    (
                        'Yes' => 'ROLE_ADMIN',
                    ),
                    'ROLE_TEACHER' => array
                    (
                        'Yes' => 'ROLE_TEACHER'
                    ),
                    'ROLE_STUDENT' => array
                    (
                        'Yes' => 'ROLE_STUDENT'
                    ),
                    'ROLE_PARENT' => array
                    (
                        'Yes' => 'ROLE_PARENT'
                    ),
                ) 
                ,
                'multiple' => true,
                'required' => true,
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
