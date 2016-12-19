<?php

namespace ConsoleBundle\Entity\Level1;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yahoo
 *
 * @ORM\Table(name="feed_level1_yahoo")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Level1\YahooRepository")
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
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="op", type="float", nullable=true)
     */
    private $op;

    /**
     * @var float
     *
     * @ORM\Column(name="hi", type="float", nullable=true)
     */
    private $hi;

    /**
     * @var float
     *
     * @ORM\Column(name="lo", type="float", nullable=true)
     */
    private $lo;

    /**
     * @var float
     *
     * @ORM\Column(name="chp", type="float", nullable=true)
     */
    private $chp;

    /**
     * @var float
     *
     * @ORM\Column(name="ch", type="float", nullable=true)
     */
    private $ch;

    /**
     * @var string
     *
     * @ORM\Column(name="ttime", type="string", length=20, nullable=true)
     */
    private $ttime;

    /**
     * @var float
     *
     * @ORM\Column(name="bid", type="float", nullable=true)
     */
    private $bid;

    /**
     * @var float
     *
     * @ORM\Column(name="ask", type="float", nullable=true)
     */
    private $ask;

    /**
     * @var float
     *
     * @ORM\Column(name="bidsize", type="float", nullable=true)
     */
    private $bidsize;

    /**
     * @var float
     *
     * @ORM\Column(name="asksize", type="float", nullable=true)
     */
    private $asksize;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount", type="integer", nullable=true)
     */
    private $tcount;

    /**
     * @var int
     *
     * @ORM\Column(name="vol", type="integer", nullable=true)
     */
    private $vol;

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
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * @param float $op
     */
    public function setOp($op)
    {
        $this->op = $op;
    }

    /**
     * @return float
     */
    public function getHi()
    {
        return $this->hi;
    }

    /**
     * @param float $hi
     */
    public function setHi($hi)
    {
        $this->hi = $hi;
    }

    /**
     * @return float
     */
    public function getLo()
    {
        return $this->lo;
    }

    /**
     * @param float $lo
     */
    public function setLo($lo)
    {
        $this->lo = $lo;
    }

    /**
     * @return float
     */
    public function getChp()
    {
        return $this->chp;
    }

    /**
     * @param float $chp
     */
    public function setChp($chp)
    {
        $this->chp = $chp;
    }

    /**
     * @return float
     */
    public function getCh()
    {
        return $this->ch;
    }

    /**
     * @param float $ch
     */
    public function setCh($ch)
    {
        $this->ch = $ch;
    }

    /**
     * @return string
     */
    public function getTtime()
    {
        return $this->ttime;
    }

    /**
     * @param string $ttime
     */
    public function setTtime($ttime)
    {
        $this->ttime = $ttime;
    }

    /**
     * @return float
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param float $bid
     */
    public function setBid($bid)
    {
        $this->bid = $bid;
    }

    /**
     * @return float
     */
    public function getAsk()
    {
        return $this->ask;
    }

    /**
     * @param float $ask
     */
    public function setAsk($ask)
    {
        $this->ask = $ask;
    }

    /**
     * @return float
     */
    public function getBidsize()
    {
        return $this->bidsize;
    }

    /**
     * @param float $bidsize
     */
    public function setBidsize($bidsize)
    {
        $this->bidsize = $bidsize;
    }

    /**
     * @return float
     */
    public function getAsksize()
    {
        return $this->asksize;
    }

    /**
     * @param float $asksize
     */
    public function setAsksize($asksize)
    {
        $this->asksize = $asksize;
    }

    /**
     * @return int
     */
    public function getTcount()
    {
        return $this->tcount;
    }

    /**
     * @param int $tcount
     */
    public function setTcount($tcount)
    {
        $this->tcount = $tcount;
    }

    /**
     * @return int
     */
    public function getVol()
    {
        return $this->vol;
    }

    /**
     * @param int $vol
     */
    public function setVol($vol)
    {
        $this->vol = $vol;
    }
}

