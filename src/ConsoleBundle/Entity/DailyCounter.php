<?php

namespace ConsoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyCounter
 *
 * @ORM\Table(name="feed_history_daily_counter")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\DailyCounterRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DailyCounter
{

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=5)
     * @ORM\Id
     *
     */
    private $ticker;

    /**
     * @var int
     *
     * @ORM\Column(name="exchange", type="integer")
     */
    private $exchange;

    /**
     * @var bool
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;

    /**
     * @var bool
     *
     * @ORM\Column(name="writen", type="boolean")
     */
    private $writen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;


    /**
     * Get ticker
     *
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * Set ticker
     *
     * @param string $ticker
     *
     * @return DailyCounter
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set exchange
     *
     * @param integer $exchange
     *
     * @return DailyCounter
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange
     *
     * @return int
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return DailyCounter
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return bool
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set writen
     *
     * @param boolean $writen
     *
     * @return DailyCounter
     */
    public function setWriten($writen)
    {
        $this->writen = $writen;

        return $this;
    }

    /**
     * Get writen
     *
     * @return bool
     */
    public function getWriten()
    {
        return $this->writen;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return DailyCounter
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return DailyCounter
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

    }
}

