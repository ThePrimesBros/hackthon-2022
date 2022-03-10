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
                'required'   => false
            ])
            ->add('graph2', CheckboxType::class, [
                'required'   => false
            ])
            ->add('graph3', CheckboxType::class, [
                'required'   => false
            ])
            ->add('graph3', CheckboxType::class, [
                'required'   => false
            ])
            ->add('graph4', CheckboxType::class, [
                'required'   => false
            ])
            ->add('graph5', CheckboxType::class, [
                'required'   => false
            ])
            ->add('graph6', CheckboxType::class, [
                'required'   => false
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
