<?php

namespace ConsoleBundle\Entity\Premarket;

use Doctrine\ORM\Mapping as ORM;

/**
 * Google
 *
 * @ORM\Table(name="feed_premarket_google")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Premarket\GoogleRepository")
 */
class Google
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
     * @ORM\Column(name="pchp", type="float", nullable=true)
     */
    private $pchp;

    /**
     * @var float
     *
     * @ORM\Column(name="pch", type="float", nullable=true)
     */
    private $pch;


    /**
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;
    }

    /**
     * Set pprice
     *
     * @param float $pprice
     *
     * @return Google
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
     * @return Google
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
     * @return Google
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
}

