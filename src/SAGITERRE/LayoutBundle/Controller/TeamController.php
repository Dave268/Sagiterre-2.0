<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 17/09/2017
 * Time: 19:42
 */

namespace SAGITERRE\LayoutBundle\Controller;

use SAGITERRE\LayoutBundle\Entity\TeamList;
use SAGITERRE\LayoutBundle\Form\TeamListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TeamController extends Controller
{
    public function addTeamAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $team = new TeamList();
            $form   = $this->get('form.factory')->create(TeamListType::class, $team);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

                $team->uploadImage();

                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();

                return $this->redirectToRoute('sagiterre_core_about');
            }

            return $this->render('SAGITERRELayoutBundle:forms:addteam.html.twig', array(
                'form'         => $form->createView(),
            ));
        }
    }
}
