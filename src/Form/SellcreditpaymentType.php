<?php

namespace App\Form;

use App\Entity\Sellcreditpayment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellcreditpaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalAmount')
            ->add('regdate')
            ->add('regetdate')
            ->add('orderTime')
            ->add('registeredby')
            ->add('sellcredit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sellcreditpayment::class,
        ]);
    }
}
