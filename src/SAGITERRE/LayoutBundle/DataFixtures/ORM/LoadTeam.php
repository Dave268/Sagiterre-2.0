<?php
// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadTeam.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\Team;

class LoadTeam implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'Notre Equipe',
            'Ceux à qui vous avez affaire',)
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $team = new Team();
            $team->setTitle($message[0]);
            $team->setSubtitle($message[1]);


            // On la persiste
            $manager->persist($team);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
