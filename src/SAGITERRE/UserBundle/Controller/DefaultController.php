<?php

namespace SAGITERRE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SAGITERREUserBundle:Default:index.html.twig');
    }
}
