<?php

namespace SAGITERRE\LayoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherActivities
 *
 * @ORM\Table(name="sg_layout_other_activities")
 * @ORM\Entity(repositoryClass="SAGITERRE\LayoutBundle\Repository\OtherActivitiesRepository")
 */
class OtherActivities
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
     * @ORM\Column(name="columnOneIntro", type="text")
     */
    private $columnOneIntro;

    /**
     * @var string
     *
     * @ORM\Column(name="columnTwoIntro", type="text")
     */
    private $columnTwoIntro;

    /**
     * @var string
     *
     * @ORM\Column(name="columnThreeIntro", type="text")
     */
    private $columnThreeIntro;

    /**
     * @var string
     *
     * @ORM\Column(name="columnOneContent", type="text")
     */
    private $columnOneContent;

    /**
     * @var string
     *
     * @ORM\Column(name="columnTwoContent", type="text")
     */
    private $columnTwoContent;

    /**
     * @var string
     *
     * @ORM\Column(name="columnThreeContent", type="text")
     */
    private $columnThreeContent;

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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return OtherActivities
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
     * Set columnOneIntro
     *
     * @param string $columnOneIntro
     *
     * @return OtherActivities
     */
    public function setColumnOneIntro($columnOneIntro)
    {
        $this->columnOneIntro = $columnOneIntro;

        return $this;
    }

    /**
     * Get columnOneIntro
     *
     * @return string
     */
    public function getColumnOneIntro()
    {
        return $this->columnOneIntro;
    }

    /**
     * Set columnTwoIntro
     *
     * @param string $columnTwoIntro
     *
     * @return OtherActivities
     */
    public function setColumnTwoIntro($columnTwoIntro)
    {
        $this->columnTwoIntro = $columnTwoIntro;

        return $this;
    }

    /**
     * Get columnTwoIntro
     *
     * @return string
     */
    public function getColumnTwoIntro()
    {
        return $this->columnTwoIntro;
    }

    /**
     * Set columnThreeIntro
     *
     * @param string $columnThreeIntro
     *
     * @return OtherActivities
     */
    public function setColumnThreeIntro($columnThreeIntro)
    {
        $this->columnThreeIntro = $columnThreeIntro;

        return $this;
    }

    /**
     * Get columnThreeIntro
     *
     * @return string
     */
    public function getColumnThreeIntro()
    {
        return $this->columnThreeIntro;
    }

    /**
     * Set columnOneContent
     *
     * @param string $columnOneContent
     *
     * @return OtherActivities
     */
    public function setColumnOneContent($columnOneContent)
    {
        $this->columnOneContent = $columnOneContent;

        return $this;
    }

    /**
     * Get columnOneContent
     *
     * @return string
     */
    public function getColumnOneContent()
    {
        return $this->columnOneContent;
    }

    /**
     * Set columnTwoContent
     *
     * @param string $columnTwoContent
     *
     * @return OtherActivities
     */
    public function setColumnTwoContent($columnTwoContent)
    {
        $this->columnTwoContent = $columnTwoContent;

        return $this;
    }

    /**
     * Get columnTwoContent
     *
     * @return string
     */
    public function getColumnTwoContent()
    {
        return $this->columnTwoContent;
    }

    /**
     * Set columnThreeContent
     *
     * @param string $columnThreeContent
     *
     * @return OtherActivities
     */
    public function setColumnThreeContent($columnThreeContent)
    {
        $this->columnThreeContent = $columnThreeContent;

        return $this;
    }

    /**
     * Get columnThreeContent
     *
     * @return string
     */
    public function getColumnThreeContent()
    {
        return $this->columnThreeContent;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return OtherActivities
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
     * @return OtherActivities
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
     * Set active
     *
     * @param boolean $active
     *
     * @return OtherActivities
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

    /**
     * Set title
     *
     * @param string $title
     *
     * @return OtherActivities
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
}
