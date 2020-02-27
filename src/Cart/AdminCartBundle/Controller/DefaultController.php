<?php

namespace Cart\AdminCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@AdminCart/Default/index.html.twig');
    }
}
