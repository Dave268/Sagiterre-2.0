<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 10:20
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionThreeOne.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionThreeOne;

class LoadSectionThreeOne implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'QUI SOMMES-NOUS',
            'Les chevaux, un merveilleux mirroir',
            'Sagi-Terre souhaite contribuer à un monde où l\'humain cultive un lien sensible et bienveillant au vivant qui l\'entoure et à lui-même. Nous pensons que cela passe, entre autre, par une meilleure connaissance de soi, de notre nature profonde d\'humain. Nous proposons des moments d\'exploration au travers: de l\'hippothérapie (avec les chevaux), de stages et ateliers pour enfants et adultes, de la méthode de Libération des Cuirasses, d\'un accompagnement individualisé.',
            'Untitled 8.jpg',
            'bundles/Layout/images/Untitled 8.jpg'
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $sectionThreeOne = new SectionThreeOne();
            $sectionThreeOne->setTitle($message[0]);
            $sectionThreeOne->setSubtitle($message[1]);
            $sectionThreeOne->setContent($message[2]);
            $sectionThreeOne->setImageAlt($message[3]);
            $sectionThreeOne->setImagePath($message[4]);

            // On la persiste
            $manager->persist($sectionThreeOne);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
