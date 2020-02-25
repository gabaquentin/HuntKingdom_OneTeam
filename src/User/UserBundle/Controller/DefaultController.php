<?php

namespace User\UserBundle\Controller;

use Emergency\EmergencyBundle\Entity\Expedition;
use Emergency\EmergencyBundle\Entity\Urgence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }

    public function indexAdminAction()
    {
        return $this->render('@User/Default/indexAdmin.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('@User/Default/apropos.html.twig');
    }

    public function contactAction()
    {
        return $this->render('@User/Default/contact.html.twig');
    }

    public function profilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $urgence = $em->getRepository("EmergencyBundle:Urgence")->findAll();
        $exp = $em->getRepository("EmergencyBundle:Expedition")->findAll();
        return $this->render('@User/Default/profil.html.twig',array('urgence'=>$urgence,'expedition'=>$exp));
    }

    public function endExpAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository(Expedition::class)->find($id);

        if (!$exp) {
            throw $this->createNotFoundException(
                'No exp found for id '.$id
            );
        }

        $exp->setStatut('2');
        $em->flush();

        return $this->redirectToRoute('user_profile');
    }
}
