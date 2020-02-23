<?php

namespace SAV\SAVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SAVBundle:Default:index.html.twig');
    }
}
