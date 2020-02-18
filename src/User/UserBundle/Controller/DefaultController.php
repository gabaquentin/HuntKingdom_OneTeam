<?php

namespace User\UserBundle\Controller;

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
}
