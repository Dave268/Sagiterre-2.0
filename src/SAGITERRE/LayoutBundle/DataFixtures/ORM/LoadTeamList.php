<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 25/08/2017
 * Time: 18:29
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadTeamList.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionTwoList;
use SAGITERRE\LayoutBundle\Entity\TeamList;

class LoadTeamList implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $slides = array(array(
            'Antoinette Goubau',
            'Venenatis bibendum, magna lectu fermentum lacus, vel accumsan.',
            'antoinette.jpg',
            'bundles/Layout/images/antoinette.jpg'),
            array(
                'Marguerite de Limbourg',
                'Diam tellus eu velit. Donec lobortis lacinia nisl quis scelerisque.',
                'marguerite.jpg',
                'bundles/Layout/images/marguerite.jpg'),
        );

        foreach ($slides as $slide) {
            // On crée la catégorie
            $teamList = new TeamList();
            $teamList->setName($slide[0]);
            $teamList->setIntro($slide[1]);
            $teamList->setImageAlt($slide[2]);
            $teamList->setImagePath(($slide[3]));

            // On la persiste
            $manager->persist($teamList);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
