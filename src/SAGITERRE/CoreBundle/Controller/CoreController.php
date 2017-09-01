<?php

namespace SAGITERRE\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SAGITERRE\LayoutBundle\Entity\WelcomeMessage;
use SAGITERRE\LayoutBundle\Entity\SlideImage;
use SAGITERRE\LayoutBundle\Entity\SectionTwo;
use SAGITERRE\LayoutBundle\Entity\SectionTwoList;
use SAGITERRE\LayoutBundle\Entity\SectionThreeOne;
use SAGITERRE\LayoutBundle\Entity\SectionThreeTwo;
use SAGITERRE\LayoutBundle\Entity\SectionThreeThree;





class CoreController extends Controller
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

    public function aboutAction()
    {
        $about  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:About')->findOneBy(array('active' => '1'));
        $team = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Team')->findOneBy(array('active' => '1'));
        $teamList = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:TeamList')->findBy(array('active' => '1'));
        $mission  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Mission')->findOneBy(array('active' => '1'));


        return $this->render('SAGITERRECoreBundle:core:about.html.twig', array(
            'about'     => $about,
            'team'      => $team,
            'teamList'  => $teamList,
            'mission'   => $mission,
        ));
    }

    public function activitiesAction()
    {
        $activities = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Activities')->findOneBy(array('active' => '1'));
        $otherActivities  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:OtherActivities')->findOneBy(array('active' => '1'));


        return $this->render('SAGITERRECoreBundle:core:activities.html.twig', array(
            'activities'        => $activities,
            'otheractivities'   => $otherActivities,
        ));
    }

    public function newsAction()
    {
        $news = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:News')->findOneBy(array('active' => '1'));
        $newsArchives = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:NewsArchive')->findOneBy(array('active' => '1'));

        return $this->render('SAGITERRECoreBundle:core:news.html.twig', array(
            'news'              => $news,
            'newsArchives'      => $newsArchives
        ));
    }

    public function contactAction()
    {
        $contact = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Contact')->findOneBy(array('active' => '1'));

        return $this->render('SAGITERRECoreBundle:core:contact.html.twig', array(
            'contact'       => $contact,
        ));
    }
}
