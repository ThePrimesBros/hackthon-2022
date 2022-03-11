<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('entreprise')
            ->add('graph1', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Evolution T0 - T1'
            ])
            ->add('graph2', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Average T0 - T1'
            ])
            ->add('graph3', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Evolution T0 - T1'
            ])
            ->add('graph4', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Average T0 - T1'
            ])
            ->add('graph5', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison treat'
            ])
            ->add('graph6', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison treat'
            ])
            ->add('graph7', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Evolution T0 - T1 - Antioxydant'
            ])
            ->add('graph8', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Average T0 - T1 - Antioxydant'
            ])
            ->add('graph9', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Evolution T0 - T1 - Antioxydant'
            ])
            ->add('graph10', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Average T0 - T1 - Antioxydant'
            ])
            ->add('graph11', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison antioxydant treat'
            ])
            ->add('graph12', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison antioxydant treat'
            ])
            ->add('graph13', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Evolution T0 - T1 - Shield'
            ])
            ->add('graph14', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 treat - Average T0 - T1 - Shield'
            ])
            ->add('graph15', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Evolution T0 - T1 - Shield'
            ])
            ->add('graph16', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 treat - Average T0 - T1 - Shield'
            ])
            ->add('graph17', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison shield treat'
            ])
            ->add('graph18', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison shield treat'
            ])
            ->add('graph19', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Evolution T0 - T1'
            ])
            ->add('graph20', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Average T0 - T1'
            ])
            ->add('graph21', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Evolution T0 - T1'
            ])
            ->add('graph22', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Average T0 - T1'
            ])
            ->add('graph23', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison untreat'
            ])
            ->add('graph24', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison untreat'
            ])
            ->add('graph25', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Evolution T0 - T1 - Antioxydant'
            ])
            ->add('graph26', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Average T0 - T1 - Antioxydant'
            ])
            ->add('graph27', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Evolution T0 - T1 - Antioxydant'
            ])
            ->add('graph28', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Average T0 - T1 - Antioxydant'
            ])
            ->add('graph29', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison antioxydant untreat'
            ])
            ->add('graph30', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison antioxydant untreat'
            ])
            ->add('graph31', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Evolution T0 - T1 - Shield'
            ])
            ->add('graph32', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 untreat - Average T0 - T1 - Shield'
            ])
            ->add('graph33', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Evolution T0 - T1 - Shield'
            ])
            ->add('graph34', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 2 untreat - Average T0 - T1 - Shield'
            ])
            ->add('graph35', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 average comparaison shield untreat'
            ])
            ->add('graph36', CheckboxType::class, [
                'required'   => false,
                'label' => 'Product 1 and Product 2 evolution comparaison shield untreat'
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
