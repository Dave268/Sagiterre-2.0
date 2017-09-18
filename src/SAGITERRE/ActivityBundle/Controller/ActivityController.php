<?php

namespace SAGITERRE\ActivityBundle\Controller;

use SAGITERRE\ActivityBundle\Entity\Activity;
use SAGITERRE\ActivityBundle\Form\ActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ActivityController extends Controller
{
    public function addAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $activity = new Activity();
            $form   = $this->get('form.factory')->create(ActivityType::class, $activity);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $activity->uploadImage();

                $em = $this->getDoctrine()->getManager();
                $em->persist($activity);
                $em->flush();

                return $this->redirectToRoute('sagiterre_core_activities');
            }

            return $this->render('SAGITERREActivityBundle:form:form.html.twig', array(
                'form'         => $form->createView(),
            ));
        }
    }

    public function modifyAction($id, Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $activity = $this->getDoctrine()->getManager()->getRepository('SAGITERREActivityBundle:Activity')->findOneBy(array('id' => $id));

            $form   = $this->get('form.factory')->create(ActivityType::class, $activity);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                if($activity->getFile() != NULL)
                {
                    $activity->uploadImage();
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($activity);
                $em->flush();

                return $this->redirectToRoute('sagiterre_core_activities');
            }

            return $this->render('SAGITERREActivityBundle:form:form.html.twig', array(
                'form'         => $form->createView(),
            ));
        }
    }

    public function showAction($id, Request $request)
    {
            $activity = $this->getDoctrine()->getManager()->getRepository('SAGITERREActivityBundle:Activity')->findOneBy(array('id' => $id));

            return $this->render('SAGITERREActivityBundle:view:view.html.twig', array(
                'activity'         => $activity,
            ));
    }

    public function deactivateAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $activity = $this->getDoctrine()->getManager()->getRepository('SAGITERREActivityBundle:Activity')->find($id);
            $em = $this->getDoctrine()->getManager();

            $activity->deactivate();

            $em->persist($activity);
            $em->flush();
        }

        return $this->redirectToRoute('sagiterre_core_activities');
    }
}
