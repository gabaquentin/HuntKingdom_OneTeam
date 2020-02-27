<?php

namespace Boutique\BoutiqueBundle\Controller;

use Cart\CartBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBoutiqueBundle\Entity\Produits;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@Boutique/Default/index.html.twig",array('produits'=>$produits));
    }

    public function animalAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@Boutique/Default/animal.html.twig",array('produits'=>$produits));
    }

    public function pecheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@Boutique/Default/peche.html.twig",array('produits'=>$produits));
    }

    public function pecheSSAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@Boutique/Default/pecheSS.html.twig",array('produits'=>$produits));
    }

    public function ProductDetailAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->find($id);



        return $this->render("@Boutique/Default/ProductDetail.html.twig",array('produits'=>$produits));
    }

    public function addToCartAction(Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $quantite = addslashes(trim($request->get('quantite')));
            $idP = addslashes(trim($request->get('idp')));

                $entityManager = $this->getDoctrine()->getManager();

                $panier = new Panier();
                $u = $entityManager->getRepository("AppBundle:User")->find($this->getUser());
                $produit = $entityManager->getRepository("AdminBoutiqueBundle:Produits")->find($idP);
                $panier->setProduit($produit);
                $panier->setClient($u);
                $panier->setQuantite($quantite);


                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($panier);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();

        }
        return new Response('45');
    }


}
