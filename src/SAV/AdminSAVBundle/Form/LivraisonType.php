<?php

namespace  SAV\AdminSAVBundle\Form;

use SAV\AdminSAVBundle\Entity\Livreur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateliv')
            ->add('Livreur' , EntityType::class,['class'=>'AdminSAVBundle:Livreur',
                'choice_label'=>'id',
                'multiple' => false,
                   'expanded' => false,])
            ->add('prixliv')
            ->add('Ajouter', SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SAV\AdminSAVBundle\Entity\Livraison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sav_adminsavbundle_livraison';
    }


}
