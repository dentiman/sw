<?php

namespace AppBundle\Entity\Feed;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainPremarket
 *
 * @ORM\Table(name="feed_main_premarket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Feed\MainPremarketRepository")
 */
class MainPremarket
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
     * @ORM\Column(name="pvol", type="integer")
     */
    private $pvol;

    /**
     * @var int
     *
     * @ORM\Column(name="ptcount", type="integer")
     */
    private $ptcount;

    /**
     * @var float
     *
     * @ORM\Column(name="pprice", type="float")
     */
    private $pprice;

    /**
     * @var float
     *
     * @ORM\Column(name="pchp", type="float")
     */
    private $pchp;

    /**
     * @var float
     *
     * @ORM\Column(name="pch", type="float")
     */
    private $pch;


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
     * @return MainPremarket
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set pvol
     *
     * @param integer $pvol
     *
     * @return MainPremarket
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

    /**
     * Set ptcount
     *
     * @param integer $ptcount
     *
     * @return MainPremarket
     */
    public function setPtcount($ptcount)
    {
        $this->ptcount = $ptcount;

        return $this;
    }

    /**
     * Get ptcount
     *
     * @return int
     */
    public function getPtcount()
    {
        return $this->ptcount;
    }

    /**
     * Set pprice
     *
     * @param float $pprice
     *
     * @return MainPremarket
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
     * @return MainPremarket
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
     * @return MainPremarket
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

