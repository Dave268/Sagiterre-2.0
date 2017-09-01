<?php
// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadActivities.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\Activities;

class LoadActivities implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'Nos Activités',
            'Tout ca pour vous aider',)
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $activities = new Activities();
            $activities->setTitle($message[0]);
            $activities->setSubtitle($message[1]);


            // On la persiste
            $manager->persist($activities);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
