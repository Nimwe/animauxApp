<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Especes;
use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContinentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('animaux', EntityType::class, 
            array('class' => Animal::class,
                 'choice_label'=>'nom',
                 'label' => 'Choisir animal',
                 'multiple' => true, 
                 'expanded'=> true // pour faire des boutons radio et en selectionner plusieurs
    ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Continent::class,
        ]);
    }
}
