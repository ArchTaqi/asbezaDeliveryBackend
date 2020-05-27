<?php

namespace App\Form;

use App\Entity\Pricing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itemCode')
            ->add('inPrice')
            ->add('fixPrice')
            ->add('inQuantity')
            ->add('remainingQuantity')
            ->add('date')
            ->add('item')
            ->add('stockInMode')
            ->add('registeredby')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pricing::class,
        ]);
    }
}
