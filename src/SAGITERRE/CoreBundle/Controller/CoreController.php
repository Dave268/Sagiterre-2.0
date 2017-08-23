<?php

namespace SAGITERRE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SAGITERRE\LayoutBundle\Entity\WelcomeMessage;

class CoreController extends Controller
{
    public function indexAction()
    {
        $WelcomeMessage  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:WelcomeMessage')->findOneBy(array('active' => '1'));

        return $this->render('SAGITERRECoreBundle:core:index.html.twig', array(
            'WelcomeMessage' => $WelcomeMessage
        ));
    }
}
