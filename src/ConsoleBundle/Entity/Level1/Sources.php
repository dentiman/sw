<?php

namespace ConsoleBundle\Entity\Level1;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sources
 *
 * @ORM\Table(name="feed_level1_sources")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Level1\SourcesRepository")
 */
class Sources
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
     * @var \DateTime
     *
     * @ORM\Column(name="ttime", type="time", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;
    
    
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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
     * @return Sources
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



    /**
     * Set source
     *
     * @param string $source
     *
     * @return Sources
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}

