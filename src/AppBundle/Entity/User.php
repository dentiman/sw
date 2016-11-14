<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="premium_expire_at", type="datetime", nullable=true)
     */
    private $premiumExpireAt;


    /**
     * Set premiumExpireAt
     *
     * @param \DateTime $premiumExpireAt
     *
     * @return User
     */
    public function setPremiumExpireAt($premiumExpireAt)
    {
        $this->premiumExpireAt = $premiumExpireAt;

        return $this;
    }

    /**
     * Get premiumExpireAt
     *
     * @return \DateTime
     */
    public function getPremiumExpireAt()
    {
        return $this->premiumExpireAt;
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * {@inheritdoc}
     */
    public function isPremium()
    {

        if (null !== $this->premiumExpireAt && $this->premiumExpireAt->getTimestamp() > time()) {
            return true;
        }

        return false;
    }
}