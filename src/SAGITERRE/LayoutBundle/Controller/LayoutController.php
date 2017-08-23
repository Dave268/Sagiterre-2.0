<?php

namespace SAGITERRE\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LayoutController extends Controller
{
    public function indexAction()
    {
        return $this->render('SAGITERRELayoutBundle:Default:index.html.twig');
    }
}
