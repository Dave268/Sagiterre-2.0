<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 25/08/2017
 * Time: 18:18
 */
// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionTwo.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionTwo;

class LoadSectionTwo implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'LE TROUPEAU',
            'C\'est grace à eux que nous allons allez plus loin!',)
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $sectionTwo = new SectionTwo();
            $sectionTwo->setTitle($message[0]);
            $sectionTwo->setSubtitle($message[1]);


            // On la persiste
            $manager->persist($sectionTwo);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
