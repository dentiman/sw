<?php

namespace ConsoleBundle\Entity\Level1;

use Doctrine\ORM\Mapping as ORM;

/**
 * Google
 *
 * @ORM\Table(name="feed_level1_google")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Level1\GoogleRepository")
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
     * @return \DateTime
     */
    public function getTtime()
    {
        return $this->ttime;
    }

    /**
     * @param \DateTime $ttime
     */
    public function setTtime($ttime)
    {
        $this->ttime = $ttime;
    }
}

