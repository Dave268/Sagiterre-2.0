<?php

namespace SAGITERRE\LayoutBundle\Controller;

use SAGITERRE\LayoutBundle\Entity\About;
use SAGITERRE\LayoutBundle\Entity\Activities;
use SAGITERRE\LayoutBundle\Entity\Contact;
use SAGITERRE\LayoutBundle\Entity\Mission;
use SAGITERRE\LayoutBundle\Entity\News;
use SAGITERRE\LayoutBundle\Entity\NewsArchive;
use SAGITERRE\LayoutBundle\Entity\OtherActivities;
use SAGITERRE\LayoutBundle\Entity\SectionFive;
use SAGITERRE\LayoutBundle\Entity\SectionThreeOne;
use SAGITERRE\LayoutBundle\Entity\SectionThreeThree;
use SAGITERRE\LayoutBundle\Entity\SectionThreeTwo;
use SAGITERRE\LayoutBundle\Entity\SectionTwo;
use SAGITERRE\LayoutBundle\Entity\SectionTwoList;
use SAGITERRE\LayoutBundle\Entity\SectionFour;
use SAGITERRE\LayoutBundle\Entity\Team;
use SAGITERRE\LayoutBundle\Entity\WelcomeMessage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;


class LayoutController extends Controller
{
    public function indexAction()
    {
        return $this->render('SAGITERRELayoutBundle:Default:index.html.twig');
    }

    public function  modifyWelcomeMessageAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $welcomeMessage = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:WelcomeMessage')->find($id);
                $newMessage = new WelcomeMessage();

                //$form = $this->get('form.factory')->create(WelcomeMessageTitleType::class, $newMessage);

                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'welcometitle'  && $formData['message'] != $welcomeMessage->getTitle()) OR ($part == 'welcomesubtitle'  && $formData['message'] != $welcomeMessage->getSubtitle()) OR ($part == 'welcomecolumnone'  && $formData['message'] != $welcomeMessage->getColumnOne()) OR ($part == 'welcomecolumntwo'  && $formData['message'] != $welcomeMessage->getColumnTwo()) OR ($part == 'welcomecolumnthree'  && $formData['message'] != $welcomeMessage->getColumnThree())) {
                        $newMessage->setTitle($welcomeMessage->getTitle());
                        $newMessage->setSubtitle($welcomeMessage->getSubtitle());
                        $newMessage->setColumnOne($welcomeMessage->getColumnOne());
                        $newMessage->setColumnTwo($welcomeMessage->getColumnTwo());
                        $newMessage->setColumnThree($welcomeMessage->getColumnThree());

                        if ($part == 'welcometitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'welcomesubtitle') {
                            $newMessage->setSubitle($formData['message']);
                        } elseif ($part == 'welcomecolumnone') {
                            $newMessage->setColumnOne($formData['message']);
                        } elseif ($part == 'welcomecolumntwo') {
                            $newMessage->setColumnTwo($formData['message']);
                        } elseif ($part == 'welcomecolumnthree') {
                            $newMessage->setColumnThree($formData['message']);
                        }

                        $welcomeMessage->setActive(false);
                        $em->persist($welcomeMessage);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $welcomeMessage->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                    }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionTwoAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionTwo = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwo')->find($id);
                $newMessage = new SectionTwo();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectiontwotitle'  && $formData['message'] != $sectionTwo->getTitle()) OR ($part == 'sectiontwosubtitle'  && $formData['message'] != $sectionTwo->getSubtitle())) {
                        $newMessage->setTitle($sectionTwo->getTitle());
                        $newMessage->setSubtitle($sectionTwo->getSubtitle());

                        if ($part == 'sectiontwotitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'sectiontwosubtitle') {
                            $newMessage->setSubitle($formData['message']);
                        }

                        $sectionTwo->setActive(false);
                        $em->persist($sectionTwo);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionTwo->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                    }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionThreeOneAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionThreeOne = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeOne')->find($id);
                $newMessage = new SectionThreeOne();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectionthreeonetitle'  && $formData['message'] != $sectionThreeOne->getTitle()) OR ($part == 'sectionthreeonesubtitle'  && $formData['message'] != $sectionThreeOne->getSubtitle()) OR ($part == 'sectionthreeonecontent'  && $formData['message'] != $sectionThreeOne->getContent())) {
                        $newMessage->setTitle($sectionThreeOne->getTitle());
                        $newMessage->setSubtitle($sectionThreeOne->getSubtitle());
                        $newMessage->setContent($sectionThreeOne->getContent());
                        $newMessage->setImageAlt($sectionThreeOne->getImageAlt());
                        $newMessage->setImagePath($sectionThreeOne->getImagePath());


                        if ($part == 'sectionthreeonetitle') {
                            $newMessage->setTitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreeonesubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreeonecontent') {
                            $newMessage->setContent($formData['message']);
                        }

                        $sectionThreeOne->setActive(false);
                        $em->persist($sectionThreeOne);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionThreeOne->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionThreeTwoAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionThreeTwo = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeTwo')->find($id);
                $newMessage = new SectionThreeTwo();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectionthreetwotitle' && $formData['message'] != $sectionThreeTwo->getTitle()) OR ($part == 'sectionthreetwosubtitle'  && $formData['message'] != $sectionThreeTwo->getSubtitle()) OR ($part == 'sectionthreetwocontent'  && $formData['message'] != $sectionThreeTwo->getContent())) {
                        $newMessage->setTitle($sectionThreeTwo->getTitle());
                        $newMessage->setSubtitle($sectionThreeTwo->getSubtitle());
                        $newMessage->setContent($sectionThreeTwo->getContent());
                        $newMessage->setImageAlt($sectionThreeTwo->getImageAlt());
                        $newMessage->setImagePath($sectionThreeTwo->getImagePath());

                        if ($part == 'sectionthreetwotitle') {
                            $newMessage->setTitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreetwosubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreetwocontent') {
                            $newMessage->setContent($formData['message']);
                        }

                        $sectionThreeTwo->setActive(false);
                        $em->persist($sectionThreeTwo);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionThreeTwo->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionThreeThreeAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionThreeThree = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionThreeThree')->find($id);
                $newMessage = new SectionThreeThree();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectionthreethreetitle'  && $formData['message'] != $sectionThreeThree->getTitle()) OR ($part == 'sectionthreethreesubtitle'  && $formData['message'] != $sectionThreeThree->getSubtitle()) OR ($part == 'sectionthreethreecontent'  && $formData['message'] != $sectionThreeThree->getContent())) {
                        $newMessage->setTitle($sectionThreeThree->getTitle());
                        $newMessage->setSubtitle($sectionThreeThree->getSubtitle());
                        $newMessage->setContent($sectionThreeThree->getContent());
                        $newMessage->setImageAlt($sectionThreeThree->getImageAlt());
                        $newMessage->setImagePath($sectionThreeThree->getImagePath());



                        if ($part == 'sectionthreethreetitle') {
                            $newMessage->setTitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreethreesubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }
                        elseif ($part == 'sectionthreethreecontent') {
                            $newMessage->setContent($formData['message']);
                        }

                        $sectionThreeThree->setActive(false);
                        $em->persist($sectionThreeThree);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionThreeThree->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionFourAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionFour = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFour')->find($id);
                $newMessage = new SectionFour();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectionfourtitle'  && $formData['message'] != $sectionFour->getTitle()) OR ($part == 'sectionfoursubtitle'  && $formData['message'] != $sectionFour->getSubtitle())) {
                        $newMessage->setTitle($sectionFour->getTitle());
                        $newMessage->setSubtitle($sectionFour->getSubtitle());

                        if ($part == 'sectionfourtitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'sectionfoursubtitle') {
                            $newMessage->setSubitle($formData['message']);
                        }

                        $sectionFour->setActive(false);
                        $em->persist($sectionFour);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionFour->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifySectionFiveAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $sectionFive = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionFive')->find($id);
                $newMessage = new SectionFive();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'sectionfivetitle'  && $formData['message'] != $sectionFive->getTitle()) OR ($part == 'sectionfivesubtitle'  && $formData['message'] != $sectionFive->getSubtitle())) {
                        $newMessage->setTitle($sectionFive->getTitle());
                        $newMessage->setSubtitle($sectionFive->getSubtitle());

                        if ($part == 'sectionfivetitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'sectionfivesubtitle') {
                            $newMessage->setSubitle($formData['message']);
                        }

                        $sectionFive->setActive(false);
                        $em->persist($sectionFive);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $sectionFive->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyAboutAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $about = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:About')->find($id);
                $newMessage = new About();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'abouttitle'  && $formData['message'] != $about->getTitle()) OR ($part == 'aboutsubtitle'  && $formData['message'] != $about->getSubtitle()) OR ($part == 'aboutintro'  && $formData['message'] != $about->getIntro()) OR ($part == 'aboutcontent'  && $formData['message'] != $about->getContent())) {
                        $newMessage->setTitle($about->getTitle());
                        $newMessage->setSubtitle($about->getSubtitle());
                        $newMessage->setIntro($about->getIntro());
                        $newMessage->setContent($about->getContent());
                        $newMessage->setImageAlt($about->getImageAlt());
                        $newMessage->setImagePath($about->getImagePath());

                        if ($part == 'abouttitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'aboutsubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        } elseif ($part == 'aboutintro') {
                            $newMessage->setIntro($formData['message']);
                        } elseif ($part == 'aboutcontent') {
                            $newMessage->setContent($formData['message']);
                        }

                        $about->setActive(false);
                        $em->persist($about);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $about->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyTeamAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $team = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Team')->find($id);
                $newMessage = new Team();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'teamtitle'  && $formData['message'] != $team->getTitle()) OR ($part == 'teamsubtitle'  && $formData['message'] != $team->getSubtitle())) {
                        $newMessage->setTitle($team->getTitle());
                        $newMessage->setSubtitle($team->getSubtitle());

                        if ($part == 'teamtitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'teamsubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }

                        $team->setActive(false);
                        $em->persist($team);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $team->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyMissionAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $mission = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Mission')->find($id);
                $newMessage = new Mission();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'missiontitle'  && $formData['message'] != $mission->getTitle()) OR ($part == 'missionsubtitle'  && $formData['message'] != $mission->getSubtitle()) OR ($part == 'missioncolumnoneintro'  && $formData['message'] != $mission->getColumnOneIntro()) OR ($part == 'missioncolumnonecontent'  && $formData['message'] != $mission->getColumnOneContent()) OR ($part == 'missioncolumntwointro'  && $formData['message'] != $mission->getColumnTwoIntro()) OR ($part == 'missioncolumntwocontent'  && $formData['message'] != $mission->getColumnTwoContent()) OR ($part == 'missioncolumnthreeintro'  && $formData['message'] != $mission->getColumnThreeIntro()) OR ($part == 'missioncolumnthreecontent'  && $formData['message'] != $mission->getColumnThreeContent())) {
                        $newMessage->setTitle($mission->getTitle());
                        $newMessage->setSubtitle($mission->getSubtitle());
                        $newMessage->setColumnOneIntro($mission->getColumnOneIntro());
                        $newMessage->setColumnOneContent($mission->getColumnOneContent());
                        $newMessage->setColumnTwoIntro($mission->getColumnTwoIntro());
                        $newMessage->setColumnTwoContent($mission->getColumnTwoContent());
                        $newMessage->setColumnThreeIntro($mission->getColumnThreeIntro());
                        $newMessage->setColumnThreeContent($mission->getColumnThreeContent());


                        if ($part == 'missiontitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'missionsubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        } elseif ($part == 'missioncolumnoneintro') {
                            $newMessage->setColumnOneIntro($formData['message']);
                        } elseif ($part == 'missioncolumnonecontent') {
                            $newMessage->setColumnOneContent($formData['message']);
                        } elseif ($part == 'missioncolumntwointro') {
                            $newMessage->setColumnTwoIntro($formData['message']);
                        } elseif ($part == 'missioncolumntwocontent') {
                            $newMessage->setColumnTwoContent($formData['message']);
                        } elseif ($part == 'missioncolumnthreeintro') {
                            $newMessage->setColumnThreeIntro($formData['message']);
                        } elseif ($part == 'missioncolumnthreecontent') {
                            $newMessage->setColumnThreeContent($formData['message']);
                        }

                        $mission->setActive(false);
                        $em->persist($mission);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $mission->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyActivitiesAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $activities = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Activities')->find($id);
                $newMessage = new Activities();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'activitiestitle'  && $formData['message'] != $activities->getTitle()) OR ($part == 'activitiessubtitle'  && $formData['message'] != $activities->getSubtitle())) {
                        $newMessage->setTitle($activities->getTitle());
                        $newMessage->setSubtitle($activities->getSubtitle());

                        if ($part == 'activitiestitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'activitiessubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }

                        $activities->setActive(false);
                        $em->persist($activities);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $activities->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyOtherActivitiesAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $otherAct = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:OtherActivities')->find($id);
                $newMessage = new OtherActivities();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'otheractivitiestitle'  && $formData['message'] != $otherAct->getTitle()) OR ($part == 'otheractivitiessubtitle'  && $formData['message'] != $otherAct->getSubtitle()) OR ($part == 'otheractivitiescolumnoneintro'  && $formData['message'] != $otherAct->getColumnOneIntro()) OR ($part == 'otheractivitiescolumnonecontent'  && $formData['message'] != $otherAct->getColumnOneContent()) OR ($part == 'otheractivitiescolumntwointro'  && $formData['message'] != $otherAct->getColumnTwoIntro()) OR ($part == 'otheractivitiescolumntwocontent'  && $formData['message'] != $otherAct->getColumnTwoContent()) OR ($part == 'otheractivitiescolumnthreeintro'  && $formData['message'] != $otherAct->getColumnThreeIntro()) OR ($part == 'otheractivitiescolumnthreecontent'  && $formData['message'] != $otherAct->getColumnThreeContent())) {
                        $newMessage->setTitle($otherAct->getTitle());
                        $newMessage->setSubtitle($otherAct->getSubtitle());
                        $newMessage->setColumnOneIntro($otherAct->getColumnOneIntro());
                        $newMessage->setColumnOneContent($otherAct->getColumnOneContent());
                        $newMessage->setColumnTwoIntro($otherAct->getColumnTwoIntro());
                        $newMessage->setColumnTwoContent($otherAct->getColumnTwoContent());
                        $newMessage->setColumnThreeIntro($otherAct->getColumnThreeIntro());
                        $newMessage->setColumnThreeContent($otherAct->getColumnThreeContent());


                        if ($part == 'otheractivitiestitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'otheractivitiessubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        } elseif ($part == 'otheractivitiescolumnoneintro') {
                            $newMessage->setColumnOneIntro($formData['message']);
                        } elseif ($part == 'otheractivitiescolumnonecontent') {
                            $newMessage->setColumnOneContent($formData['message']);
                        } elseif ($part == 'otheractivitiescolumntwointro') {
                            $newMessage->setColumnTwoIntro($formData['message']);
                        } elseif ($part == 'otheractivitiescolumntwocontent') {
                            $newMessage->setColumnTwoContent($formData['message']);
                        } elseif ($part == 'otheractivitiescolumnthreeintro') {
                            $newMessage->setColumnThreeIntro($formData['message']);
                        } elseif ($part == 'otheractivitiescolumnthreecontent') {
                            $newMessage->setColumnThreeContent($formData['message']);
                        }

                        $otherAct->setActive(false);
                        $em->persist($otherAct);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $otherAct->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyContactAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $contact = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:Contact')->find($id);
                $newMessage = new Contact();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'contacttitle'  && $formData['message'] != $contact->getTitle()) OR ($part == 'contactsubtitle'  && $formData['message'] != $contact->getSubtitle()) OR ($part == 'contactadress'  && $formData['message'] != $contact->getAdress()) OR ($part == 'contactphone'  && $formData['message'] != $contact->getPhone()) OR ($part == 'contactmail'  && $formData['message'] != $contact->getMail())) {
                        $newMessage->setTitle($contact->getTitle());
                        $newMessage->setSubtitle($contact->getSubtitle());
                        $newMessage->setAdress($contact->getAdress());
                        $newMessage->setPhone($contact->getPhone());
                        $newMessage->setMail($contact->getMail());


                        if ($part == 'contacttitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'contactsubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        } elseif ($part == 'contactadress') {
                            $newMessage->setAdress($formData['message']);
                        } elseif ($part == 'contactphone') {
                            $newMessage->setPhone($formData['message']);
                        } elseif ($part == 'contactmail') {
                            $newMessage->setMail($formData['message']);
                        }

                        $contact->setActive(false);
                        $em->persist($contact);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $contact->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyNewsAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $news = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:News')->find($id);
                $newMessage = new News();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'newstitle'  && $formData['message'] != $news->getTitle()) OR ($part == 'newssubtitle'  && $formData['message'] != $news->getSubtitle())) {
                        $newMessage->setTitle($news->getTitle());
                        $newMessage->setSubtitle($news->getSubtitle());

                        if ($part == 'newstitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'newssubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }

                        $news->setActive(false);
                        $em->persist($news);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $news->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function  modifyNewsArchivesAction($id, $part, Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            if($id < 1)
            {
                throw new NotFoundHttpException('Ce titre n\'existe pas.');
            }
            else
            {
                $news = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:NewsArchives')->find($id);
                $newMessage = new NewsArchive();


                $formData = array();
                $form = $this->get('form.factory')->createBuilder(FormType::class, $formData)
                    ->add('message',         TextareaType::class)
                    ->getForm();

                if ($request->isMethod('POST')) {

                    $form->handleRequest($request);
                    $formData = $form->getData();
                    $em = $this->getDoctrine()->getManager();

                    if(($part == 'newsarchivestitle'  && $formData['message'] != $news->getTitle()) OR ($part == 'newsarchivessubtitle'  && $formData['message'] != $news->getSubtitle())) {
                        $newMessage->setTitle($news->getTitle());
                        $newMessage->setSubtitle($news->getSubtitle());

                        if ($part == 'newsarchivestitle') {
                            $newMessage->setTitle($formData['message']);
                        } elseif ($part == 'newsarchivessubtitle') {
                            $newMessage->setSubtitle($formData['message']);
                        }

                        $news->setActive(false);
                        $em->persist($news);
                        $em->persist($newMessage);
                        $em->flush();

                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $newMessage->getId(),
                                'title' => $newMessage->getTitle()
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    else
                    {
                        if ($request->isXmlHttpRequest()) {
                            $json = json_encode(array(
                                'id' => $news->getId(),
                            ));

                            $response = new Response($json);
                            $response->headers->set('Content-Type', 'application/json');

                            return $response;
                        }
                    }
                    return $this->redirect($this->generateUrl('sagiterre_core_homepage'));
                }
                return $this->get('templating')->renderResponse('SAGITERRELayoutBundle:forms:welcomeMessageTitleForm.html.twig', array(
                    'form'          => $form->createView()));
            }
        }
    }

    public function deactivateHorseAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $horse = $this->getDoctrine()->getManager()->getRepository('SAGITERRELayoutBundle:SectionTwoList')->find($id);
            $em = $this->getDoctrine()->getManager();

            $horse->deactivate();

            $em->persist($horse);
            $em->flush();
        }

        return $this->redirectToRoute('sagiterre_core_homepage');
    }


}
