<?php

namespace Cart\CartBundle\Controller;

use Cart\CartBundle\Entity\Commande;
use Cart\CartBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $panier=$em->getRepository("CartBundle:Panier")->findAll();
        $produit=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();
        return $this->render('@Cart/Default/index.html.twig',array('panier'=>$panier,'produits'=>$produit));
    }

    public function updateAction (Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $quantite = addslashes(trim($request->get('quantite')));
            $idP = addslashes(trim($request->get('idp')));

            $em = $this->getDoctrine()->getManager();
            $panier = $em->getRepository(Panier::class)->find($idP);

            if (!$panier) {
                throw $this->createNotFoundException(
                    'No cart found for id '
                );
            }

            $panier->setQuantite($quantite);
            $em->flush();

            return $this->redirectToRoute('cart_homepage');

        }
        return new Response('45');
    }

    public function dellIAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $panier= $em->getRepository("CartBundle:Panier")->findBy(['produit'=>$id]);

        foreach ($panier as $value) {
            $em->remove($value);
            $em->flush();
        }


        return $this->redirectToRoute('cart_homepage');
    }

    public function addCommandeAction($pp)
    {
        $commande = new Commande();
        $em = $this->getDoctrine()->getManager();
        $u = $em->getRepository("AppBundle:User")->find($this->getUser());
        $panier= $em->getRepository("CartBundle:Panier")->findBy(['client'=>$u]);

        foreach ($panier as $value) {
            $commande->setUtilisateur($u);
            $commande->setEtat('en cours');
            $commande->setDate(date("Y/m/d H:i"));
            $commande->setDateCommande(strtotime("now"));
            $commande->setProduit($value->getProduit());
            $commande->setPrixtotal($pp);
            $em->persist($commande);
            $em->flush();

        }


        return $this->redirectToRoute('user_homepage');

    }
}
