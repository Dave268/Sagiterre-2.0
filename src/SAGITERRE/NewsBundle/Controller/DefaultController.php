<?php

namespace SAGITERRE\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SAGITERRENewsBundle:Default:index.html.twig');
    }
}
