<?php

namespace Cart\AdminCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("CartBundle:Commande")->findAll();
        return $this->render('@AdminCart/Default/index.html.twig',array('commande'=>$commande));
    }
}
