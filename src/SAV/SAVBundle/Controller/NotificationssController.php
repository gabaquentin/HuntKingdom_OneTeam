<?php

namespace SAV\SAVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SAV\SAVBundle\Entity\Reclamation;
use SAV\SAVBundle\Entity\Notificationss;

class NotificationssController extends Controller
{
    public function displayAction()
    {
        $notification = $this->getDoctrine()->getManager()->getRepository('SAVBundle:Notificationss')->findAll();
        return$this->render('@SAV/Reclamation/Notification.html.twig' , array('notificationss'=>$notification));
    }

}