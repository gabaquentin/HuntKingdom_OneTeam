<?php

namespace Cart\AdminCartBundle\Controller;

use Cart\CartBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("CartBundle:Commande")->findAll();
        return $this->render('@AdminCart/Default/index.html.twig',array('commande'=>$commande));
    }

    public function detailCommandeAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository("CartBundle:Commande")->findBy(array('dateCommande' => $id));



        return $this->render("@AdminCart/Default/detailCommande.html.twig",array('commande'=>$commande,'id'=>$id));
    }

    public function traiterCommandeAction($id)
    {
        /*
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("CartBundle:Commande")->findBy(array('dateCommande' => $id));

        if (!$commande) {
            throw $this->createNotFoundException(
                'No command found for id '.$id
            );
        }

        $commande->setEtat();
        $em->flush();

        return $this->redirectToRoute('admin_emergency_homepage');
        */
    }
}
