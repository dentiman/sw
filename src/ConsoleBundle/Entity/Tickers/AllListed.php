<?php

namespace ConsoleBundle\Entity\Tickers;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllListed
 *
 * @ORM\Table(name="feed_tickers_all_listed")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Tickers\AllListedRepository")
 */
class AllListed
{
    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=255)
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="etf", type="string", length=255)
     */
    private $etf;


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
     * @return AllListed
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
     * @return AllListed
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
     * Set name
     *
     * @param string $name
     *
     * @return AllListed
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
     * Set etf
     *
     * @param string $etf
     *
     * @return AllListed
     */
    public function setEtf($etf)
    {
        $this->etf = $etf;

        return $this;
    }

    /**
     * Get etf
     *
     * @return string
     */
    public function getEtf()
    {
        return $this->etf;
    }
}

