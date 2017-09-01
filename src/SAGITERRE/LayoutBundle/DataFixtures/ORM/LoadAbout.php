<?php

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadAbout.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\About;

class LoadAbout implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'A propos',
            'Morbi et semper arcu, etiam volut',
            'Curabitur ornare volutpat sollicitudin. Nunc elementum quis dui sit amet pharetra. Vivamus hendrerit, tempor nulla non, volutpat felis. Fusce cursus fermentum pretium.',
            'Curabitur ornare volutpat sollicitudin. Nunc elementum quis dui sit amet pharetra. Vivamus id luctus ex, id tristique purus. Curabitur suscipit malesuada mollis. Morbi viverra maximus sodales. Nulla luctus, ipsum eu consectetur maximus, enim mi rhoncus nisi, non dictum neque nulla id neque. Nam bibendum molestie eleifend. Maecenas porttitor Praesent fermentum sapien sit amet sollicitudin facilisis. Nullam sed felis pulvinar, eleifend diam ac, viverra turpis. etiam cursus justo sit amet tortor cursus feugiat. ',
            'Untitled 8.jpg',
            'bundles/Layout/images/Untitled 8.jpg'
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $about = new About();
            $about->setTitle($message[0]);
            $about->setSubtitle($message[1]);
            $about->setIntro($message[2]);
            $about->setContent($message[3]);
            $about->setImageAlt($message[4]);
            $about->setImagePath($message[5]);

            // On la persiste
            $manager->persist($about);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
