<?php

namespace SAV\AdminSAVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminSVABundle:Default:index.html.twig');
    }
}
