<?php

namespace SAV\SAVBundle\Controller;

use SAV\SAVBundle\Entity\Reclamation;
use SAV\SAVBundle\Form\ReclamationType;
use SAV\SAVBundle\SAVBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReclamationController extends Controller
{
    public function indexAction()
    {
        return $this->render("@SAV/Default/index.html.twig");
    }
    ###############################################################################
    public function createAction(Request $request)
    {


        $Reclamation = new Reclamation();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ReclamationType::class, $Reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reclamation);
            $em->flush();
            return $html=$this->redirectToRoute('sav_create',array('id'=>$Reclamation->getId()));
        }
        return $this->render('@SAV/Reclamation/create.html.twig', array('reclamation'=>$Reclamation,
            'form' => $form->createView()));
    }
    ####################################################################
    public function readAction(Request$request)
    {
        $em = $this->getDoctrine()->getManager();
        $Reclamations=$em->getRepository('SAVBundle:Reclamation')->findAll();


        return $this->render('@SAV/Reclamation/read.html.twig',array('Reclamations'=>$Reclamations));
    }
    ###################################################################
    public function updateAction(Request $request, $id)
    {
        $Reclamation = new Reclamation();
        $em = $this->getDoctrine()->getManager();
        $Reclamations = $em->getRepository("SAVBundle:Reclamation")->find($id);
        $form = $this->createForm(ReclamationType::class, $Reclamations);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('sav_read',array('id'=>$Reclamations->getId()));
        }
        return $this->render('@SAV/Reclamation/update.html.twig', array('reclamation'=>$Reclamations,
            'form' => $form->createView()));
    }
    #########################################################
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Reclamations=$em->getRepository("SAVBundle:Reclamation")->find($id);
        $em->remove($Reclamations);
        $em->flush();
        return $this->redirectToRoute('sav_read');
    }
    #########################################################
    public function searchAction(Request  $request)
    {

        $em = $this->getDoctrine()->getManager();
        $Reclamation = $em->getRepository(Reclamation::class)->findAll();

        if ($request->isMethod("POST"))
        {
            $typeReclamation = $request->get('typeReclamation');
            $Reclamation = $em->getRepository('SAVBundle:Reclamation')->findBy(array('typeReclamation' => $typeReclamation));
        }

        return $this->render("@SAV/Reclamation/search.html.twig", array('Reclamation' => $Reclamation));

    }
        ##########################################################################

        public function pdfAction(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();

            $Reclamation = $em->getRepository('SAVBundle:Reclamation')->find($id);

            $snappy = $this->get("knp_snappy.pdf");

            $html = $this->renderView("@SAV/Reclamation/pdf.html.twig", array(
                "title" => "Reclamation",
                'Reclamation' => $Reclamation
            ));
            $filename = "articleSingle";


            return new  Response(
                $snappy->getOutputFromHtml($html),
                200,

                array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename"' . $filename . '.pdf"',
                )
            );


        }

    }
