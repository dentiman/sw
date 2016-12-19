<?php

namespace ConsoleBundle\Entity\Tickers;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tickers
 *
 * @ORM\Table(name="feed_basic_tickers")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Basic\TickersRepository")
 */
class Tickers
{
    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=10, nullable=true)
     * @ORM\Id
     *
     */
    private $ticker;

    /**
     * @var int
     *
     * @ORM\Column(name="exchange", type="integer", nullable=true)
     */
    private $exchange;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="etf", type="string", length=255, nullable=true)
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
     * @return Tickers
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
     * @return Tickers
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
     * @return Tickers
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
     * @return Tickers
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

