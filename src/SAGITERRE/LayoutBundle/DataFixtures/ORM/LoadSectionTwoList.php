<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 25/08/2017
 * Time: 18:29
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionTwoList.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionTwoList;

class LoadSectionTwoList implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $slides = array(array(
                'Canelle',
                'bundles/Layout/images/canelle.png'),
            array(
                'Chesta',
                'bundles/Layout/images/chesta.png'),
            array(
                'Gramoun',
                'bundles/Layout/images/gramoun.png'),
            array(
                'Guérane',
                'bundles/Layout/images/guerane.png'),
            array(
                'Vénus',
                'bundles/Layout/images/venus.png'),
        );

        foreach ($slides as $slide) {
            // On crée la catégorie
            $sectionTwoList = new SectionTwoList();
            $sectionTwoList->setName($slide[0]);
            $sectionTwoList->setPath($slide[1]);

            // On la persiste
            $manager->persist($sectionTwoList);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
