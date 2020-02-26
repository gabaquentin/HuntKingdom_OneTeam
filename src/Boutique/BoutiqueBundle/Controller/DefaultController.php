<?php

namespace Boutique\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBoutiqueBundle\Entity\Produits;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@Boutique/Default/index.html.twig",array('produits'=>$produits));
    }
    public function ProductDetailAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->find($id);



        return $this->render("@Boutique/Default/ProductDetail.html.twig",array('produits'=>$produits));
    }



}
