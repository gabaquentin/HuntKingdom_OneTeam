<?php

namespace SAV\SAVBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Gregwar\CaptchaBundle\GregwarCaptchaBundle;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices1 =[''=>'' ,
            'Erreur'=>'Erreur','Deception'=>'Deception','Delai'=>'Delai','Defaut'=>'Defaut'
            ];
        $choices =[
            'En cours'=>'En cours','Traitée'=>'Traitée','Rejetée'=>'Rejetée'
        ];
        $builder->add('typeReclamation',ChoiceType::class,['choices'=>$choices1,
            'expanded'=>false,
            'label'=>'Type Recalation:',])
            ->add('description')
            ->add('dateReclamation')
            ->add('dateAchat')
            ->add('etatReclamation',ChoiceType::class,['choices'=>$choices,
                'expanded'=>false,
                'label'=>'Etat Recalation:',])
            ->add('email',EmailType::class)


        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SAV\SAVBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sav_savbundle_reclamation';
    }


}
