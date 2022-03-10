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
                'label' => 'Product 1 - Evolution T0 - T1'
            ])
            ->add('graph2', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 - Average T0 - T1'
            ])
            ->add('graph3', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 - Evolution T0 - T1'
            ])
            ->add('graph4', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 - Average T0 - T1'
            ])
            ->add('graph5', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison'
            ])
            ->add('graph6', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison'
            ])
            ->add('graph7', CheckboxType::class, [
                'required'   => false
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
