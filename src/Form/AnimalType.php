<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Especes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('image')
            ->add('nom_latin')
            ->add('especes', EntityType::class, 
                   array('class' => Especes::class,
                        'choice_label'=>'Libelle',
                        'label' => 'Choisir espèces',
                        'multiple' => false))
            ->add('continents', EntityType::class, 
                    array('class' => Continent::class,
                        'choice_label'=>'libelle',
                        'label' => 'Choisir le continent où vit l\'animal',
                        'multiple' => true,
                        'expanded'=>true,
                        'by_reference'=>false ))           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
