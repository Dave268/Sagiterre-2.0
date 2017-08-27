<?php
/**
 * Created by PhpStorm.
 * User: davidgoubau
 * Date: 26/08/2017
 * Time: 11:40
 */

// src/SAGITERRE/UserBundle/Entity/User.php

namespace SAGITERRE\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="sg_user")
 * @ORM\Entity(repositoryClass="SAGITERRE\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}