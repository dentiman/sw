<?php

namespace ConsoleBundle\Entity\Tickers;

use Doctrine\ORM\Mapping as ORM;

/**
 * NasdaqListed
 *
 * @ORM\Table(name="feed_tickers_nasdaq_listed")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Tickers\NasdaqListedRepository")
 */
class NasdaqListed
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="marketCategory", type="string", length=255)
     */
    private $marketCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="test", type="string", length=255)
     */
    private $test;

    /**
     * @var string
     *
     * @ORM\Column(name="financialStatus", type="string", length=255)
     */
    private $financialStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="lotSize", type="string", length=255)
     */
    private $lotSize;

    /**
     * @var string
     *
     * @ORM\Column(name="etf", type="string", length=255)
     */
    private $etf;

    /**
     * @var string
     *
     * @ORM\Column(name="nextShares", type="string", length=255)
     */
    private $nextShares;


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
     * @return NasdaqListed
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return NasdaqListed
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
     * Set marketCategory
     *
     * @param string $marketCategory
     *
     * @return NasdaqListed
     */
    public function setMarketCategory($marketCategory)
    {
        $this->marketCategory = $marketCategory;

        return $this;
    }

    /**
     * Get marketCategory
     *
     * @return string
     */
    public function getMarketCategory()
    {
        return $this->marketCategory;
    }

    /**
     * Set test
     *
     * @param string $test
     *
     * @return NasdaqListed
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
     * Set financialStatus
     *
     * @param string $financialStatus
     *
     * @return NasdaqListed
     */
    public function setFinancialStatus($financialStatus)
    {
        $this->financialStatus = $financialStatus;

        return $this;
    }

    /**
     * Get financialStatus
     *
     * @return string
     */
    public function getFinancialStatus()
    {
        return $this->financialStatus;
    }

    /**
     * Set lotSize
     *
     * @param string $lotSize
     *
     * @return NasdaqListed
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
     * Set etf
     *
     * @param string $etf
     *
     * @return NasdaqListed
     */
    public function setEtf($etf)
    {
        $this->etf = $etf;

        return $this;
    }

    /**
     * Get eTF
     *
     * @return string
     */
    public function getEtf()
    {
        return $this->etf;
    }

    /**
     * Set nextShares
     *
     * @param string $nextShares
     *
     * @return NasdaqListed
     */
    public function setNextShares($nextShares)
    {
        $this->nextShares = $nextShares;

        return $this;
    }

    /**
     * Get nextShares
     *
     * @return string
     */
    public function getNextShares()
    {
        return $this->nextShares;
    }
}

