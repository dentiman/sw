<?php

namespace ConsoleBundle\Entity\Premarket;

use Doctrine\ORM\Mapping as ORM;

/**
 * Iqfeed
 *
 * @ORM\Table(name="feed_premarket_iqfeed")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Premarket\IqfeedRepository")
 */
class Iqfeed
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
     * @var int
     *
     * @ORM\Column(name="pvol", type="integer", nullable=true)
     */
    private $pvol;

    /**
     * @var int
     *
     * @ORM\Column(name="ptcount", type="integer", nullable=true)
     */
    private $ptcount;


    /**
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     * @return Iqfeed
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
     * @return Iqfeed
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
     * @return Iqfeed
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
}

