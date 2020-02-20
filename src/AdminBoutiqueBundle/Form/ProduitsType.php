<?php

namespace AdminBoutiqueBundle\Form;

use AdminBoutiqueBundle\Entity\Fournisseur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProduit')
                ->add('quantite')
                ->add('categorie',ChoiceType::class,['choices'=>['Choisir Type'=>'','Chasse Au Fusil'=>'chasse au fusil','Chasse Animal'=>'chasse animal','Pêche'=>'peche','Pêche Sous-Marine'=>'peche SS']])
                ->add('prix')
                ->add('Fournisseur',EntityType::class, ['class'=>Fournisseur::class, 'choice_label'=>'nomFournisseur','multiple'=>false ,  ])
                ->add('image', FileType::class, array('data_class' => null))
                ->add('description')
                ->add('Ajouter',SubmitType::class);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBoutiqueBundle\Entity\Produits'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminboutiquebundle_produits';
    }


}
