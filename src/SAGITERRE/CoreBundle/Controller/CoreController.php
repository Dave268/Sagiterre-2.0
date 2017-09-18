<?php

namespace SAGITERRE\CoreBundle\Controller;

use SAGITERRE\LayoutBundle\Form\SectionTwoListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SAGITERRE\LayoutBundle\Entity\SectionTwoList;
use Symfony\Component\HttpFoundation\Request;






class CoreController extends Controller
{
    public function indexAction(Request $request)
    {
        $welcomeMessage  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:WelcomeMessage')->findOneBy(array('active' => '1'));
        $slideImages = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SlideImage')->findBy(array('active' => '1'));
        $sectionTwo = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwo')->findOneBy(array('active' => '1'));
        $sectionTwoList = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwoList')->findBy(array('active' => '1'));
        $sectionFour = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFour')->findOneBy(array('active' => '1'));
        $sectionFive = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFive')->findOneBy(array('active' => '1'));

        $news = $this->getDoctrine()->getManager()->getRepository('SAGITERRENewsBundle:News')->findBy(array('active' => '1'), array('id' => 'DESC'), 4, 0);


        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $horse = new SectionTwoList();
            $formHorse   = $this->get('form.factory')->create(SectionTwoListType::class, $horse);

            if ($request->isMethod('POST') && $formHorse->handleRequest($request)->isValid()) {
                // Ajoutez cette ligne :
                // c'est elle qui déplace l'image là où on veut les stocker
                $horse->upload();

                // Le reste de la méthode reste inchangé
                $em = $this->getDoctrine()->getManager();
                $em->persist($horse);
                $em->flush();
            }

            return $this->render('SAGITERRECoreBundle:core:index.html.twig', array(
                'WelcomeMessage'    => $welcomeMessage,
                'slideImages'       => $slideImages,
                'sectionTwo'        => $sectionTwo,
                'sectionTwoList'    => $sectionTwoList,
                'sectionFour'       => $sectionFour,
                'sectionFive'       => $sectionFive,
                'formHorse'         => $formHorse->createView(),
                'news'              => $news
            ));
        }






        return $this->render('SAGITERRECoreBundle:core:index.html.twig', array(
            'WelcomeMessage'    => $welcomeMessage,
            'slideImages'       => $slideImages,
            'sectionTwo'        => $sectionTwo,
            'sectionTwoList'    => $sectionTwoList,
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
        $sectionThreeOne  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeOne')->findOneBy(array('active' => '1'));
        $sectionThreeTwo  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeTwo')->findOneBy(array('active' => '1'));
        $sectionThreeThree  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeThree')->findOneBy(array('active' => '1'));


        return $this->render('SAGITERRECoreBundle:core:about.html.twig', array(
            'about'             => $about,
            'team'              => $team,
            'teamList'          => $teamList,
            'mission'           => $mission,
            'sectionThreeOne'   => $sectionThreeOne,
            'sectionThreeTwo'   => $sectionThreeTwo,
            'sectionThreeThree' => $sectionThreeThree,
        ));
    }

    public function activitiesAction()
    {
        $activities = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Activities')->findOneBy(array('active' => '1'));
        $otherActivities  = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:OtherActivities')->findOneBy(array('active' => '1'));
        $activity  = $this->getDoctrine()->getManager()->getRepository('SAGITERREActivityBundle:Activity')->findBy(array('active' => '1'));


        return $this->render('SAGITERRECoreBundle:core:activities.html.twig', array(
            'activities'        => $activities,
            'otheractivities'   => $otherActivities,
            'activity'          => $activity,
        ));
    }

    public function newsAction()
    {
        $news = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:News')->findOneBy(array('active' => '1'));
        $newsArchives = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:NewsArchive')->findOneBy(array('active' => '1'));
        $newsPosted = $this->getDoctrine()->getManager()->getRepository('SAGITERRENewsBundle:News')->findBy(array('active' => '1'), array('id' => 'desc'));

        return $this->render('SAGITERRECoreBundle:core:news.html.twig', array(
            'news'              => $news,
            'newsArchives'      => $newsArchives,
            'newsPosted'        => $newsPosted
        ));
    }

    public function contactAction()
    {
        $contact = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Contact')->findOneBy(array('active' => '1'));

        return $this->render('SAGITERRECoreBundle:core:contact.html.twig', array(
            'contact'       => $contact,
        ));
    }

    public function testAction()
    {

        return $this->render('SAGITERRECoreBundle:core:test.html.twig', array(
        ));
    }
}
