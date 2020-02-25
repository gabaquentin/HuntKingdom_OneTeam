<?php

namespace  SAV\AdminSAVBundle\Controller;

use  SAV\AdminSAVBundle\Entity\Livreur;
use  SAV\AdminSAVBundle\Form\LivreurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LivreurController extends Controller
{
    public function addLivreurAction (Request $request)
    {
        $Livreur =new Livreur();
        $form =$this->createForm(LivreurType::class,$Livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($Livreur);
            $em->flush();
            return $this->redirectToRoute('admin_sav_ListLivreur');
        }
        return $this->render('@AdminSAV/Livreur/addLivreur.html.twig',
            array('form'=>$form->createView()));
    }

    public function ListLivreurAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Livreurs=$em->getRepository('AdminSAVBundle:Livreur')->findAll();
        return $this->render('@AdminSAV/Livreur/ListLivreur.html.twig',array('Livreurs'=>$Livreurs));
    }
    public function deleteLivreurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Livreurs=$em->getRepository("AdminSAVBundle:Livreur")->find($id);
        $em->remove($Livreurs);
        $em->flush();
        return $this->redirectToRoute('admin_sav_ListLivreur');
    }

    public function updateLivreurAction(Request $request, $id)
    {
        $Livreur = new Livreur();
        $em = $this->getDoctrine()->getManager();
        $Livreurs = $em->getRepository("AdminSAVBundle:Livreur")->find($id);
        $form = $this->createForm(LivreurType::class, $Livreurs);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_sav_addLivreur',array('reference'=>$Livreurs->getId()));
        }
        return $this->render('@AdminSAV/Livreur/addLivreur.html.twig', array('livreurs'=>$Livreurs,
            'form' => $form->createView()));
    }
    ############################################################################
    public function searchLivreurAction( Request $request)
    {
        $search = new ProperetySearch();
        $form = $this->createForm(ProperetySearchType::class , $search);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $Livreurs = $em->getRepository('AdminSAVBundle:Livreur')->findAll();
        /*$Livreurs=$this->getDoctrine()->getEntityManager()->createQuery('SELECT l
                        FROM AdminSVABundle:Livreur l
                        ORDER BY  r.nom DESC');*/
        return $this->render('@AdminSAV/Livreur/search.html.twig', array(
            'current_menu' =>'Livreurs',
            'Livreurs' =>$Livreurs,
            'form'=>$form->createView()
        ));
    }
}
