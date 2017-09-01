<?php

namespace SAGITERRE\LayoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WelcomeMessage
 *
 * @ORM\Table(name="sg_layout_welcome_message")
 * @ORM\Entity(repositoryClass="SAGITERRE\LayoutBundle\Repository\WelcomeMessageRepository")
 */
class WelcomeMessage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="columnOne", type="text")
     */
    private $columnOne;

    /**
     * @var string
     *
     * @ORM\Column(name="columnTwo", type="text")
     */
    private $columnTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="columnThree", type="text")
     */
    private $columnThree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdd", type="datetime")
     */
    private $dateAdd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpdate", type="datetime", nullable=true)
     */
    private $dateUpdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = true;

    public function __construct()
    {
        $this->dateAdd = new \DateTime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return WelcomeMessage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return WelcomeMessage
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set columnOne
     *
     * @param string $columnOne
     *
     * @return WelcomeMessage
     */
    public function setColumnOne($columnOne)
    {
        $this->columnOne = $columnOne;

        return $this;
    }

    /**
     * Get columnOne
     *
     * @return string
     */
    public function getColumnOne()
    {
        return $this->columnOne;
    }

    /**
     * Set columnTwo
     *
     * @param string $columnTwo
     *
     * @return WelcomeMessage
     */
    public function setColumnTwo($columnTwo)
    {
        $this->columnTwo = $columnTwo;

        return $this;
    }

    /**
     * Get columnTwo
     *
     * @return string
     */
    public function getColumnTwo()
    {
        return $this->columnTwo;
    }

    /**
     * Set columnThree
     *
     * @param string $columnThree
     *
     * @return WelcomeMessage
     */
    public function setColumnThree($columnThree)
    {
        $this->columnThree = $columnThree;

        return $this;
    }

    /**
     * Get columnThree
     *
     * @return string
     */
    public function getColumnThree()
    {
        return $this->columnThree;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return WelcomeMessage
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return WelcomeMessage
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return WelcomeMessage
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return WelcomeMessage
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}
