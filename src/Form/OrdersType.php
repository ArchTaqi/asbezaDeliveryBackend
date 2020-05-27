<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ordercode')
            ->add('itemSellPrice')
            ->add('orderQuantity')
            ->add('orderDate')
            ->add('orderTime')
            ->add('pricing')
            ->add('paymentMode')
            ->add('paymentStatus')
            ->add('registeredby')
            ->add('itemStatus')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
