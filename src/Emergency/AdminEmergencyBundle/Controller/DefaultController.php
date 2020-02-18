<?php

namespace Emergency\AdminEmergencyBundle\Controller;

use Emergency\AdminEmergencyBundle\Entity\Expedition;
use Emergency\AdminEmergencyBundle\Entity\Urgence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $urgence = $em->getRepository("AdminEmergencyBundle:Urgence")->findAll();
        return $this->render('@AdminEmergency/Default/index.html.twig',array('urgence'=>$urgence));
    }

    public function preventionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $expedition = $em->getRepository("AdminEmergencyBundle:Expedition")->findAll();
        return $this->render('@AdminEmergency/Default/prevention.html.twig',array('expedition'=>$expedition));
    }

    public function prevention_detailExpAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $expedition = $em->getRepository("AdminEmergencyBundle:Expedition")->find($id);
        return $this->render('@AdminEmergency/Default/prevention_detailExp.html.twig',array('expedition'=>$expedition));
    }

    public  function prevention_delExpAction($id){
        $em=$this->getDoctrine()->getManager();
        $expedition=$em->getRepository(Expedition::class)->find($id);
        $em->remove($expedition);
        $em->flush();
        return $this->redirectToRoute('admin_emergency_prevention');
    }

    public  function emergency_traiterAction($id){
        $em = $this->getDoctrine()->getManager();
        $urgence = $em->getRepository(Urgence::class)->find($id);

        if (!$urgence) {
            throw $this->createNotFoundException(
                'No emergency found for id '.$id
            );
        }

        $urgence->setEtat('1');
        $em->flush();

        return $this->redirectToRoute('admin_emergency_homepage');
    }
}
