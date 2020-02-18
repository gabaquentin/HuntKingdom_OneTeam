<?php

namespace Emergency\EmergencyBundle\Form;

use Emergency\EmergencyBundle\Entity\Expedition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrgenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('expedition', EntityType::class, [
        // looks for choices from this entity
        'class' => Expedition::class,

        // uses the User.username property as the visible option string
        'choice_label' => 'nom',

        // used to render a select box, check boxes or radios
        'multiple' => false,
        'expanded' => false,
    ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emergency\EmergencyBundle\Entity\Urgence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'emergency_emergencybundle_urgence';
    }


}
