<?php

namespace SAGITERRE\NewsBundle\Controller;

use SAGITERRE\NewsBundle\Entity\News;
use SAGITERRE\NewsBundle\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    public function addAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $news = new News();
            $form   = $this->get('form.factory')->create(NewsType::class, $news);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $news->uploadImage();

                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                return $this->redirectToRoute('sagiterre_core_news');
            }

            return $this->render('SAGITERRENewsBundle:news:add.html.twig', array(
                'form'         => $form->createView(),
            ));
        }
    }
}
