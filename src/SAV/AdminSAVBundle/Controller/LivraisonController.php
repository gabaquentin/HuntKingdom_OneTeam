<?php

namespace SAV\AdminSAVBundle\Controller;

use  SAV\AdminSAVBundle\Entity\Livraison;
use  SAV\AdminSAVBundle\Form\LivraisonType;
use  SAV\AdminSAVBundle\AdminSAVBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LivraisonController extends Controller
{
    public function addLivAction (Request $request)
    {
       $Livraison =new Livraison();
       $form =$this->createForm(LivraisonType::class,$Livraison);
       $form->handleRequest($request);
       if ($form->isSubmitted())
       {
           $em=$this->getDoctrine()->getManager();
           $em->persist($Livraison);
           $em->flush();
           return $this->redirectToRoute('admin_sav_ListLivraison');
       }
      return $this->render('@AdminSAV/Livraison/addLiv.html.twig',
          array('form'=>$form->createView()));
    }

    public function ListLivraisonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Livraions=$em->getRepository('AdminSAVBundle:Livraison')->findAll();
        return $this->render('@AdminSAV/Livraison/ListLivraison.html.twig',array('Livraisons'=>$Livraions));
    }
    public function deleteLivraisonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Livraisons=$em->getRepository("AdminSAVBundle:Livraison")->find($id);
        $em->remove($Livraisons);
        $em->flush();
        return $this->redirectToRoute('admin_sav_ListLivraison');
    }

    public function updateLivraisonAction(Request $request, $id)
    {
        $Livraison = new Livraison();
        $em = $this->getDoctrine()->getManager();
        $Livraisons = $em->getRepository("AdminSAVBundle:Livraison")->find($id);
        $form = $this->createForm(LivraisonType::class, $Livraisons);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_sav_addLiv',array('reference'=>$Livraisons->getId()));
        }
        return $this->render('@AdminSAV/Livraison/addLiv.html.twig', array('Livraison'=>$Livraisons,
            'form' => $form->createView()));
    }
}
