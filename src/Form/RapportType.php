<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('entreprise')
            ->add('graph1', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 - T0 - T1'
            ])
            ->add('graph2', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 - T0 - T1'
            ])
            ->add('graph3', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison'
            ])
            ->add('graph4', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison'
            ])
            ->add('graph5', CheckboxType::class, [
                'required'   => false,
                'label' => 'Antioxydant Product 1 - T0 - T1'
            ])
            ->add('graph6', CheckboxType::class, [
                'required'   => false,
                'label' => 'Antioxydant Product 2 - T0 - T1'
            ])
            ->add('graph7', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison antixoydant'
            ])
            ->add('graph8', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison antioxydant'
            ])
            ->add('commentary', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
