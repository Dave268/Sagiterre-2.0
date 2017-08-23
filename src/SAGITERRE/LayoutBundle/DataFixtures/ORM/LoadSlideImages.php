<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 23/08/2017
 * Time: 18:31
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSlideImages.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SlideImage;

class LoadSlideImages implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $slides = array(array(
            'image1',
            'bundles/Layout/slide/images/slide2.png'),
            array(
                'image2',
                'bundles/Layout/slide/images/slide3.png'),
            array(
                'image3',
                'bundles/Layout/slide/images/slide4.png'),
        );

        foreach ($slides as $slide) {
            // On crée la catégorie
            $slideImage = new SlideImage();
            $slideImage->setAlt($slide[0]);
            $slideImage->setPath($slide[1]);

            // On la persiste
            $manager->persist($slideImage);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
