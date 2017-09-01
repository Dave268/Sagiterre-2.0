<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 31/08/2017
 * Time: 17:36
 */

// src/SAGITERRE/LayoutBundle/DataFixtures/ORM/LoadContact.php

namespace SAGITERRE\LayoutBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SAGITERRE\LayoutBundle\Entity\Contact;

class LoadContact implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $messages = array(array(
            'Nos Activités',
            'Adresse du troupeau',
            'rue de la Tour 6, Nil Pierreux (Walhain)',
            'Telephone:                     +32(0)472/259943',
            'E-mail: antoinette@sagiterre.be',)
        );

        foreach ($messages as $message) {
            // On crée la catégorie
            $contact = new Contact();
            $contact->setTitle($message[0]);
            $contact->setSubtitle($message[1]);
            $contact->setAdress($message[2]);
            $contact->setPhone($message[3]);
            $contact->setMail($message[4]);


            // On la persiste
            $manager->persist($contact);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
