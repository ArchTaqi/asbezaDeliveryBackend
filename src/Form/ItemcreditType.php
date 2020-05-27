<?php

namespace App\Form;

use App\Entity\Itemcredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemcreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalAmount')
            ->add('paidAmount')
            ->add('remainigAmount')
            ->add('ownerName')
            ->add('ownerPhone')
            ->add('paymentdate')
            ->add('paymentStatus')
            ->add('registeredby')
            ->add('pricing')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Itemcredit::class,
        ]);
    }
}
