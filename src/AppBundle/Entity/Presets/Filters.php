<?php

namespace AppBundle\Entity\Presets;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filters
 *
 * @ORM\Table(name="presets_filters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Presets\FiltersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Filters
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $slug;

    /**
     * @var array
     *
     * @ORM\Column(name="filters_data", type="array")
     */
    private $filtersData;


    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;



    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Filters
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Filters
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set filters
     *
     * @param array $filtersData
     *
     * @return Filters
     */
    public function setFiltersData($filtersData)
    {
        $this->filtersData = $filtersData;

        return $this;
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFiltersData()
    {
        return $this->filtersData;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }



    /**
     * Gets triggered only on insert
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
        $this->slug = time();
    }


    public function isAuthor($user){

        return $this->userId === $user->getId();

    }

    public function __toString() {
        return $this->name;
    }


}

