<?php

namespace ConsoleBundle\Entity\Tickers;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherListed
 *
 * @ORM\Table(name="feed_tickers_other_listed")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Tickers\OtherListedRepository")
 */
class OtherListed
{

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=255, nullable=true)
     * @ORM\Id
     *
     */
    private $ticker;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="exchange", type="string", length=255, nullable=true)
     */
    private $exchange;

    /**
     * @var string
     *
     * @ORM\Column(name="cqs_symbol", type="string", length=255, nullable=true)
     */
    private $cqsSymbol;

    /**
     * @var string
     *
     * @ORM\Column(name="etf", type="string", length=255, nullable=true)
     */
    private $etf;

    /**
     * @var string
     *
     * @ORM\Column(name="lotSize", type="string", length=255, nullable=true)
     */
    private $lotSize;

    /**
     * @var string
     *
     * @ORM\Column(name="test", type="string", length=255, nullable=true)
     */
    private $test;

    /**
     * @var string
     *
     * @ORM\Column(name="Symbol", type="string", length=255, nullable=true)
     */
    private $symbol;


    /**
     * Set symbol
     *
     * @param string $symbol
     *
     * @return OtherListed
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OtherListed
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
     * Set exchange
     *
     * @param string $exchange
     *
     * @return OtherListed
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange
     *
     * @return string
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * Set cqaSymbol
     *
     * @param string $cqsSymbol
     *
     * @return OtherListed
     */
    public function setCqsSymbol($cqsSymbol)
    {
        $this->cqsSymbol = $cqsSymbol;

        return $this;
    }

    /**
     * Get cqsSymbol
     *
     * @return string
     */
    public function getCqsSymbol()
    {
        return $this->cqsSymbol;
    }

    /**
     * Set etf
     *
     * @param string $etf
     *
     * @return OtherListed
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

    /**
     * Set lotSize
     *
     * @param string $lotSize
     *
     * @return OtherListed
     */
    public function setLotSize($lotSize)
    {
        $this->lotSize = $lotSize;

        return $this;
    }

    /**
     * Get lotSize
     *
     * @return string
     */
    public function getLotSize()
    {
        return $this->lotSize;
    }

    /**
     * Set test
     *
     * @param string $test
     *
     * @return OtherListed
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set ticker
     *
     * @param string $ticker
     *
     * @return OtherListed
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get ticker
     *
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }
}

