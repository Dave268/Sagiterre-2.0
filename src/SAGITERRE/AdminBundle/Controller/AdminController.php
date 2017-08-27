<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 14:02
 */

namespace SAGITERRE\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    public function indexAction()
    {
        $welcomeMessage  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:WelcomeMessage')->findOneBy(array('active' => '1'));
        $slideImages = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SlideImage')->findBy(array('active' => '1'));
        $sectionTwo = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwo')->findOneBy(array('active' => '1'));
        $sectionTwoList = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwoList')->findBy(array('active' => '1'));
        $sectionThreeOne  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeOne')->findOneBy(array('active' => '1'));
        $sectionThreeTwo  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeTwo')->findOneBy(array('active' => '1'));
        $sectionThreeThree  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeThree')->findOneBy(array('active' => '1'));
        $sectionFour = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFour')->findOneBy(array('active' => '1'));
        $sectionFive = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFive')->findOneBy(array('active' => '1'));


        return $this->render('SAGITERRECoreBundle:core:index.html.twig', array(
            'WelcomeMessage'    => $welcomeMessage,
            'slideImages'       => $slideImages,
            'sectionTwo'        => $sectionTwo,
            'sectionTwoList'    => $sectionTwoList,
            'sectionThreeOne'   => $sectionThreeOne,
            'sectionThreeTwo'   => $sectionThreeTwo,
            'sectionThreeThree' => $sectionThreeThree,
            'sectionFour'       => $sectionFour,
            'sectionFive'       => $sectionFive,

        ));
    }

}