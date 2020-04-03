<?php

namespace AdminBoutiqueBundle\Controller;

use AdminBoutiqueBundle\Entity\Fournisseur;
use AdminBoutiqueBundle\Entity\Mail;
use AdminBoutiqueBundle\Entity\Produits;
use AdminBoutiqueBundle\Form\FournisseurType;
use AdminBoutiqueBundle\Form\MailType;
use AdminBoutiqueBundle\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Mailer;
class FournisseurController extends Controller
{
    public function ajoutFournisseurAction(Request $request)
    {

        $fournisseur = new Fournisseur();

        $form = $this->createForm(FournisseurType::class,$fournisseur);
        $form->HandleRequest($request);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash(
                'information',
                'Ajouté Avec Succès'
            );


            return $this->redirectToRoute('admin_boutique_ajoutFournisseur');

        }

        return $this->render("@AdminBoutique/Default/ajoutFournisseur.html.twig",array('form'=>$form->createView()));
    }


    public function afficheFournisseurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $fournisseur=$em->getRepository("AdminBoutiqueBundle:Fournisseur")->findAll();



        return $this->render("@AdminBoutique/Default/afficheFournisseur.html.twig",array('fournisseur'=>$fournisseur));
    }

    public function supprimerFournisseurAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $fournisseur= $em->getRepository("AdminBoutiqueBundle:Fournisseur")->find($id);
        $em->remove($fournisseur);
        $em->flush();
        $this->addFlash(
            'info',
            'Supprimé Avec Succès'
        );


        return $this->redirectToRoute('admin_boutique_afficheFournisseur');
    }

    public function modifierFournisseurAction(Request $request, Fournisseur $Fournisseur)
    {
        $form = $this->createForm(FournisseurType::class,$Fournisseur);
        $form->HandleRequest($request);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'information',
                'Modifié Avec Succès'
            );


            return $this->redirectToRoute('admin_boutique_afficheFournisseur');

        }

        return $this->render("@AdminBoutique/Default/ajoutFournisseur.html.twig",array('form'=>$form->createView()));
    }


    public function mailFournisseurAction(Request $request, Fournisseur $Fournisseur)
    {

        $mail= new Mail();

        $em = $this->getDoctrine()->getManager();
        $fournisseur= $em->getRepository(Fournisseur::class)->find($Fournisseur);
        $adresse=$fournisseur->getEmailFournisseur();
        $nom=$fournisseur->getnomFournisseur();


        $form = $this->createForm(MailType::class,$mail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $subject= $mail->getSujet();
            $object=$mail->getObjet();

            $username='huntkingdom216@gmail.com';
            $message= \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($username)
                ->setTo($adresse)
                ->setBody($object);
            $this->get('mailer')->send($message);
            $this->addFlash(
                'in',
                'Envoyé Avec Succès'
            );


            return $this->redirectToRoute('admin_boutique_afficheFournisseur');

        }
        return $this->render('@AdminBoutique/Default/mailFournisseur.html.twig',array('f'=>$form->createView(),'adresse'=>$adresse,'nom'=>$nom));
    }


}
