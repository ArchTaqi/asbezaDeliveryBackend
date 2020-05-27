<?php

namespace App\Form;

use App\Entity\Sellcredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellcreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalAmount')
            ->add('paidAmount')
            ->add('remainingAmount')
            ->add('customerName')
            ->add('customerPhone')
            ->add('date')
            ->add('registeredby')
            ->add('orders')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sellcredit::class,
        ]);
    }
}
