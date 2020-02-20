<?php

namespace AdminBoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBoutiqueBundle:Default:index.html.twig');
    }
}
