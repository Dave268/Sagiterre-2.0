<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 10:43
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadSectionFour.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\SectionFour;

class LoadSectionFour implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $messages = array(array(
            'Les Dernières News',
            'Les choses à ne pas manquer',)
        );

        foreach ($messages as $message) {
            $sectionFour = new SectionFour();
            $sectionFour->setTitle($message[0]);
            $sectionFour->setSubtitle($message[1]);

            $manager->persist($sectionFour);
        }

        $manager->flush();
    }
}