<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 30/08/2017
 * Time: 22:08
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadOtherActivities.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\OtherActivities;

class LoadOtherActivities implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'AUTRES ACTIVITÉS',
            'Nulla pellentesque, quam sed',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Donec ut augue interdum lacus vulputate dig nissim. Pellentesque rutrum posuere.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Morbi et semper arcu. Etiam volutpat orci sol licitudin magna posuere fringilla.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $otherActivities = new OtherActivities();
            $otherActivities->setTitle($message[0]);
            $otherActivities->setSubtitle($message[1]);
            $otherActivities->setColumnOneIntro($message[2]);
            $otherActivities->setColumnOneContent($message[3]);
            $otherActivities->setColumnTwoIntro($message[4]);
            $otherActivities->setColumnTwoContent($message[5]);
            $otherActivities->setColumnThreeIntro($message[6]);
            $otherActivities->setColumnThreeContent($message[7]);

            // On la persiste
            $manager->persist($otherActivities);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
