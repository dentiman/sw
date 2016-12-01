<?php

namespace AppBundle\Entity\Feed;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainLevel1
 *
 * @ORM\Table(name="feed_main_level1")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Feed\MainLevel1Repository")
 */
class MainLevel1
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="op", type="float")
     */
    private $op;

    /**
     * @var float
     *
     * @ORM\Column(name="hi", type="float")
     */
    private $hi;

    /**
     * @var float
     *
     * @ORM\Column(name="lo", type="float")
     */
    private $lo;

    /**
     * @var float
     *
     * @ORM\Column(name="chp", type="float")
     */
    private $chp;

    /**
     * @var float
     *
     * @ORM\Column(name="ch", type="float")
     */
    private $ch;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ttime", type="time")
     */
    private $ttime;

    /**
     * @var float
     *
     * @ORM\Column(name="bid", type="float")
     */
    private $bid;

    /**
     * @var float
     *
     * @ORM\Column(name="ask", type="float")
     */
    private $ask;

    /**
     * @var float
     *
     * @ORM\Column(name="bidsize", type="float")
     */
    private $bidsize;

    /**
     * @var float
     *
     * @ORM\Column(name="asksize", type="float")
     */
    private $asksize;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount", type="integer")
     */
    private $tcount;

    /**
     * @var int
     *
     * @ORM\Column(name="vol", type="integer")
     */
    private $vol;


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
     * @return MainLevel1
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return MainLevel1
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set op
     *
     * @param float $op
     *
     * @return MainLevel1
     */
    public function setOp($op)
    {
        $this->op = $op;

        return $this;
    }

    /**
     * Get op
     *
     * @return float
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * Set hi
     *
     * @param float $hi
     *
     * @return MainLevel1
     */
    public function setHi($hi)
    {
        $this->hi = $hi;

        return $this;
    }

    /**
     * Get hi
     *
     * @return float
     */
    public function getHi()
    {
        return $this->hi;
    }

    /**
     * Set lo
     *
     * @param float $lo
     *
     * @return MainLevel1
     */
    public function setLo($lo)
    {
        $this->lo = $lo;

        return $this;
    }

    /**
     * Get lo
     *
     * @return float
     */
    public function getLo()
    {
        return $this->lo;
    }

    /**
     * Set chp
     *
     * @param float $chp
     *
     * @return MainLevel1
     */
    public function setChp($chp)
    {
        $this->chp = $chp;

        return $this;
    }

    /**
     * Get chp
     *
     * @return float
     */
    public function getChp()
    {
        return $this->chp;
    }

    /**
     * Set ch
     *
     * @param float $ch
     *
     * @return MainLevel1
     */
    public function setCh($ch)
    {
        $this->ch = $ch;

        return $this;
    }

    /**
     * Get ch
     *
     * @return float
     */
    public function getCh()
    {
        return $this->ch;
    }

    /**
     * Set ttime
     *
     * @param \DateTime $ttime
     *
     * @return MainLevel1
     */
    public function setTtime($ttime)
    {
        $this->ttime = $ttime;

        return $this;
    }

    /**
     * Get ttime
     *
     * @return \DateTime
     */
    public function getTtime()
    {
        return $this->ttime;
    }

    /**
     * Set bid
     *
     * @param float $bid
     *
     * @return MainLevel1
     */
    public function setBid($bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return float
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set ask
     *
     * @param float $ask
     *
     * @return MainLevel1
     */
    public function setAsk($ask)
    {
        $this->ask = $ask;

        return $this;
    }

    /**
     * Get ask
     *
     * @return float
     */
    public function getAsk()
    {
        return $this->ask;
    }

    /**
     * Set bidsize
     *
     * @param float $bidsize
     *
     * @return MainLevel1
     */
    public function setBidsize($bidsize)
    {
        $this->bidsize = $bidsize;

        return $this;
    }

    /**
     * Get bidsize
     *
     * @return float
     */
    public function getBidsize()
    {
        return $this->bidsize;
    }

    /**
     * Set asksize
     *
     * @param float $asksize
     *
     * @return MainLevel1
     */
    public function setAsksize($asksize)
    {
        $this->asksize = $asksize;

        return $this;
    }

    /**
     * Get asksize
     *
     * @return float
     */
    public function getAsksize()
    {
        return $this->asksize;
    }

    /**
     * Set tcount
     *
     * @param integer $tcount
     *
     * @return MainLevel1
     */
    public function setTcount($tcount)
    {
        $this->tcount = $tcount;

        return $this;
    }

    /**
     * Get tcount
     *
     * @return int
     */
    public function getTcount()
    {
        return $this->tcount;
    }

    /**
     * Set vol
     *
     * @param integer $vol
     *
     * @return MainLevel1
     */
    public function setVol($vol)
    {
        $this->vol = $vol;

        return $this;
    }

    /**
     * Get vol
     *
     * @return int
     */
    public function getVol()
    {
        return $this->vol;
    }
}

