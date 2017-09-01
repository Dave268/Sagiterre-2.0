<?php

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadMission.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\Mission;

class LoadMission implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'Notre mission',
            'Fusce lacinia nunc non rhoncus',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Donec ut augue interdum lacus vulputate dig nissim. Pellentesque rutrum posuere.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
            'Morbi et semper arcu. Etiam volutpat orci sol licitudin magna posuere fringilla.',
            'Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.Curabitur erat diam, dapibus eget efficitur vel, cumsan volutpat. Phasellus semper.',
        )
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $mission = new Mission();
            $mission->setTitle($message[0]);
            $mission->setSubtitle($message[1]);
            $mission->setColumnOneIntro($message[2]);
            $mission->setColumnOneContent($message[3]);
            $mission->setColumnTwoIntro($message[4]);
            $mission->setColumnTwoContent($message[5]);
            $mission->setColumnThreeIntro($message[6]);
            $mission->setColumnThreeContent($message[7]);

            // On la persiste
            $manager->persist($mission);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
