<?php

namespace SAGITERRE\LayoutBundle\Controller;

use SAGITERRE\LayoutBundle\Entity\SectionFive;
use SAGITERRE\LayoutBundle\Entity\SectionThreeOne;
use SAGITERRE\LayoutBundle\Entity\SectionThreeThree;
use SAGITERRE\LayoutBundle\Entity\SectionThreeTwo;
use SAGITERRE\LayoutBundle\Entity\SectionTwo;
use SAGITERRE\LayoutBundle\Entity\SectionFour;
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

}
