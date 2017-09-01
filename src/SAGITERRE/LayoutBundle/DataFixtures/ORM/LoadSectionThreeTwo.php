<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 10:26
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionThreeTwo.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionThreeTwo;

class LoadSectionThreeTwo implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'Notre Histoire',
            'Une équipe de passionés',
            'Après 7 années de travail en hippothérapie à la Ferme Équestre de Louvain la Neuve, un nouveau tournant s\'est présenté. J\'avais soif d\'indépendance, de découvertes toujours plus loin dans ces domaines de l\'humain, de l\'énergétique, de la nature, de l\'animal, ... et j\'ai décidé de suivre cet appel. J\'ai travaillé deux ans en tant qu\'indépendante, toujours dans l\'accompagnement des personnes par la relation au cheval dans un magnifique endroit qui me permettait de travailler avec des chevaux en prairie, dans des grands espaces.',
            'IMG_1533.JPG',
            'bundles/Layout/images/IMG_1533.JPG'
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $sectionThreeTwo = new SectionThreeTwo();
            $sectionThreeTwo->setTitle($message[0]);
            $sectionThreeTwo->setSubtitle($message[1]);
            $sectionThreeTwo->setContent($message[2]);
            $sectionThreeTwo->setImageAlt($message[3]);
            $sectionThreeTwo->setImagePath($message[4]);

            // On la persiste
            $manager->persist($sectionThreeTwo);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
