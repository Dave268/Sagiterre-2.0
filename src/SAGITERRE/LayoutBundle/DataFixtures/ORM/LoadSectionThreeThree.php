<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 10:27
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionThreeThree.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionThreeThree;

class LoadSectionThreeThree implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'DAME NATURE',
            'Une approche de la nature et de soi',
            'C\'est riche de tout ce cheminement et dans la simplicité de ce que je suis devenue aujourd\'hui que j\'aime partager des moments sous forme d\'ateliers, de stages, de rencontres individuelles, ... J\'aime observer et vivre dans ce lieu avec ses chevaux et ses habitants, avec toutes les personnes qui y passent plus ou moins longtemps, j\'aime conduire ce navire si vivant, si subtile et en même temps si simple. Tout y est, il n\'y a plus qu\'à y goûter, à recevoir, à vivre.',
            'page-1_img04',
            'bundles/Layout/sectionthree/images/page-1_img04.jpg'
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $sectionThreeThree = new SectionThreeThree();
            $sectionThreeThree->setTitle($message[0]);
            $sectionThreeThree->setSubtitle($message[1]);
            $sectionThreeThree->setContent($message[2]);
            $sectionThreeThree->setImageAlt($message[3]);
            $sectionThreeThree->setImagePath($message[4]);

            // On la persiste
            $manager->persist($sectionThreeThree);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}