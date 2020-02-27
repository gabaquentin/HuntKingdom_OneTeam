<?php

namespace Pub\PubBundle\Form;

use Event\adminEventBundle\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class pubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEntreprise')
            ->add('description')
            ->add('date')
            ->add('event',EntityType::class,[
                'class' => Event::class,
                'choice_label'=>'nom',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('image', FileType::class,array('label'=>'inserer une image','data_class' => null))
            ->add('soumettre',SubmitType::class)
            ->add('reset',ResetType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pub\PubBundle\Entity\pub'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pub_pubbundle_pub';
    }


}
