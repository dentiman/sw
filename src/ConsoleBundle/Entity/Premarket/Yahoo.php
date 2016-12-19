<?php

namespace ConsoleBundle\Entity\Premarket;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yahoo
 *
 * @ORM\Table(name="feed_premarket_yahoo")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Premarket\YahooRepository")
 */
class Yahoo
{
    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=10)
     * @ORM\Id
     *
     */
    private $ticker;

    /**
     * @var float
     *
     * @ORM\Column(name="pprice", type="float", nullable=true)
     */
    private $pprice;

    /**
     * @var float
     *
     * @ORM\Column(name="pchp", type="float",nullable=true)
     */
    private $pchp;

    /**
     * @var float
     *
     * @ORM\Column(name="pch", type="float", nullable=true)
     */
    private $pch;

    /**
     * @var int
     *
     * @ORM\Column(name="pvol", type="integer", nullable=true)
     */
    private $pvol;

    /**
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     * @return Yahoo
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;
        return $this;
    }

    /**
     * Set pprice
     *
     * @param float $pprice
     *
     * @return Yahoo
     */
    public function setPprice($pprice)
    {
        $this->pprice = $pprice;

        return $this;
    }

    /**
     * Get pprice
     *
     * @return float
     */
    public function getPprice()
    {
        return $this->pprice;
    }

    /**
     * Set pchp
     *
     * @param float $pchp
     *
     * @return Yahoo
     */
    public function setPchp($pchp)
    {
        $this->pchp = $pchp;

        return $this;
    }

    /**
     * Get pchp
     *
     * @return float
     */
    public function getPchp()
    {
        return $this->pchp;
    }

    /**
     * Set pch
     *
     * @param float $pch
     *
     * @return Yahoo
     */
    public function setPch($pch)
    {
        $this->pch = $pch;

        return $this;
    }

    /**
     * Get pch
     *
     * @return float
     */
    public function getPch()
    {
        return $this->pch;
    }

    /**
     * Set pvol
     *
     * @param integer $pvol
     *
     * @return Yahoo
     */
    public function setPvol($pvol)
    {
        $this->pvol = $pvol;

        return $this;
    }

    /**
     * Get pvol
     *
     * @return int
     */
    public function getPvol()
    {
        return $this->pvol;
    }
}

