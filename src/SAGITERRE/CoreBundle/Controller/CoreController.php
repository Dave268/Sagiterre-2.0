<?php

namespace SAGITERRE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SAGITERRE\LayoutBundle\Entity\WelcomeMessage;

class CoreController extends Controller
{
    public function indexAction()
    {
        $welcomeMessage  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:WelcomeMessage')->findOneBy(array('active' => '1'));
        $slideImages = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SlideImage')->findBy(array('active' => '1'));

        return $this->render('SAGITERRECoreBundle:core:index.html.twig', array(
            'WelcomeMessage'    => $welcomeMessage,
            'slideImages'       =>$slideImages
        ));
    }
}
