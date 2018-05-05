<?php

namespace App\Form;

use App\Entity\Auction;
use App\Entity\Collection;
use App\Entity\Monitor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditMonitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('emailTitle')
            ->add('emailBody')
            ->add('auction', EntityType::class, [
                'class' => Auction::class,
                'choice_label' => 'title',
                'placeholder' => 'Choose an auction',
            ])
            ->add('collection', EntityType::class, [
                'class' => Collection::class,
                'choice_label' => 'getNameWithCodesCount',
                'placeholder' => 'Choose an collection',
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Monitor::class,
        ]);
    }
}
