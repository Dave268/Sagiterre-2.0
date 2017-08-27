<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 10:43
 */
// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionFive.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionFive;

class LoadSectionFive implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $messages = array(array(
            'Gallerie',
            'Quelques images',)
        );

        foreach ($messages as $message) {
            $sectionFive = new SectionFive();
            $sectionFive->setTitle($message[0]);
            $sectionFive->setSubtitle($message[1]);

            $manager->persist($sectionFive);
        }

        $manager->flush();
    }
}