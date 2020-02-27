<?php

namespace Pub\AdminPubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@AdminPub/Default/index.html.twig');
    }
}
