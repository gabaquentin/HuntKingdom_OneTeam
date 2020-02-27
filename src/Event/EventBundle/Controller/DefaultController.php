<?php

namespace Event\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("adminEventBundle:Event")->findAll();
        return $this->render('@Event/Default/index.html.twig',array('event'=>$event));
    }
}
