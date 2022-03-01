<?php

namespace App\Form;

use App\Entity\ProgMuscul;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusculationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('nom')
            ->add('time')
            ->add('espace')
            ->add('sportif')
            ->add('coach')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProgMuscul::class,
        ]);
    }
}
