<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 23/08/2017
 * Time: 17:02
 */
// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadWelcomeMessage.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\WelcomeMessage;

class LoadWelcomeMessage implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'BIENVENU CHEZ SAGI-TERRE',
            'Une approche sensible du Cheval, de la Nature, du Corps en mouvement ... pour un développement de la personne.',
            'Sagi-Terre souhaite contribuer à un monde où l\'humain cultive un lien sensible et bienveillant au vivant qui l\'entoure et à lui-même. Nous pensons que cela passe, entre autre, par une meilleure connaissance de soi, de notre nature profonde d\'humain. Nous proposons des moments d\'exploration au travers:',
            'de l\'hippothérapie (avec les chevaux), de stages et ateliers pour enfants et adultes, de la méthode de Libération des Cuirasses, d\'un accompagnement individualisé.',
            'Les chevaux et la Nature dont nous faisons intimement partie seront nos guides et révélateurs dans ces rencontres pour apprendre à se connaître, à se faire confiance et offrir le meilleur de soi.'
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $WelcomeMessage = new WelcomeMessage();
            $WelcomeMessage->setTitle($message[0]);
            $WelcomeMessage->setSubtitle($message[1]);
            $WelcomeMessage->setColumnOne($message[2]);
            $WelcomeMessage->setColumnTwo($message[3]);
            $WelcomeMessage->setColumnThree($message[4]);

            // On la persiste
            $manager->persist($WelcomeMessage);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
