<?php

namespace AppBundle\Entity\Feed;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainMinutePrev
 *
 * @ORM\Table(name="feed_main_minute_prev")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Feed\MainMinutePrevRepository")
 */
class MainMinutePrev
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
     * @ORM\Column(name="price1m", type="float", nullable=true)
     */
    private $price1m;

    /**
     * @var int
     *
     * @ORM\Column(name="vol1m", type="integer", nullable=true)
     */
    private $vol1m;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount1m", type="integer", nullable=true)
     */
    private $tcount1m;

    /**
     * @var float
     *
     * @ORM\Column(name="price5m", type="float", nullable=true)
     */
    private $price5m;

    /**
     * @var int
     *
     * @ORM\Column(name="vol5m", type="integer", nullable=true)
     */
    private $vol5m;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount5m", type="integer", nullable=true)
     */
    private $tcount5m;

    /**
     * @var float
     *
     * @ORM\Column(name="price10m", type="float", nullable=true)
     */
    private $price10m;

    /**
     * @var int
     *
     * @ORM\Column(name="vol10m", type="integer", nullable=true)
     */
    private $vol10m;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount10m", type="integer", nullable=true)
     */
    private $tcount10m;

    /**
     * @var float
     *
     * @ORM\Column(name="price15m", type="float", nullable=true)
     */
    private $price15m;

    /**
     * @var int
     *
     * @ORM\Column(name="vol15m", type="integer", nullable=true)
     */
    private $vol15m;

    /**
     * @var int
     *
     * @ORM\Column(name="tcount15m", type="integer", nullable=true)
     */
    private $tcount15m;


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
     * @return MainMinutePrev
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set price1m
     *
     * @param float $price1m
     *
     * @return MainMinutePrev
     */
    public function setPrice1m($price1m)
    {
        $this->price1m = $price1m;

        return $this;
    }

    /**
     * Get price1m
     *
     * @return float
     */
    public function getPrice1m()
    {
        return $this->price1m;
    }

    /**
     * Set vol1m
     *
     * @param integer $vol1m
     *
     * @return MainMinutePrev
     */
    public function setVol1m($vol1m)
    {
        $this->vol1m = $vol1m;

        return $this;
    }

    /**
     * Get vol1m
     *
     * @return int
     */
    public function getVol1m()
    {
        return $this->vol1m;
    }

    /**
     * Set tcount1m
     *
     * @param integer $tcount1m
     *
     * @return MainMinutePrev
     */
    public function setTcount1m($tcount1m)
    {
        $this->tcount1m = $tcount1m;

        return $this;
    }

    /**
     * Get tcount1m
     *
     * @return int
     */
    public function getTcount1m()
    {
        return $this->tcount1m;
    }

    /**
     * Set price5m
     *
     * @param float $price5m
     *
     * @return MainMinutePrev
     */
    public function setPrice5m($price5m)
    {
        $this->price5m = $price5m;

        return $this;
    }

    /**
     * Get price5m
     *
     * @return float
     */
    public function getPrice5m()
    {
        return $this->price5m;
    }

    /**
     * Set vol5m
     *
     * @param integer $vol5m
     *
     * @return MainMinutePrev
     */
    public function setVol5m($vol5m)
    {
        $this->vol5m = $vol5m;

        return $this;
    }

    /**
     * Get vol5m
     *
     * @return int
     */
    public function getVol5m()
    {
        return $this->vol5m;
    }

    /**
     * Set tcount5m
     *
     * @param integer $tcount5m
     *
     * @return MainMinutePrev
     */
    public function setTcount5m($tcount5m)
    {
        $this->tcount5m = $tcount5m;

        return $this;
    }

    /**
     * Get tcount5m
     *
     * @return int
     */
    public function getTcount5m()
    {
        return $this->tcount5m;
    }

    /**
     * Set price10m
     *
     * @param float $price10m
     *
     * @return MainMinutePrev
     */
    public function setPrice10m($price10m)
    {
        $this->price10m = $price10m;

        return $this;
    }

    /**
     * Get price10m
     *
     * @return float
     */
    public function getPrice10m()
    {
        return $this->price10m;
    }

    /**
     * Set vol10m
     *
     * @param string $vol10m
     *
     * @return MainMinutePrev
     */
    public function setVol10m($vol10m)
    {
        $this->vol10m = $vol10m;

        return $this;
    }

    /**
     * Get vol10m
     *
     * @return string
     */
    public function getVol10m()
    {
        return $this->vol10m;
    }

    /**
     * Set tcount10m
     *
     * @param integer $tcount10m
     *
     * @return MainMinutePrev
     */
    public function setTcount10m($tcount10m)
    {
        $this->tcount10m = $tcount10m;

        return $this;
    }

    /**
     * Get tcount10m
     *
     * @return int
     */
    public function getTcount10m()
    {
        return $this->tcount10m;
    }

    /**
     * Set price15m
     *
     * @param float $price15m
     *
     * @return MainMinutePrev
     */
    public function setPrice15m($price15m)
    {
        $this->price15m = $price15m;

        return $this;
    }

    /**
     * Get price15m
     *
     * @return float
     */
    public function getPrice15m()
    {
        return $this->price15m;
    }

    /**
     * Set vol15m
     *
     * @param integer $vol15m
     *
     * @return MainMinutePrev
     */
    public function setVol15m($vol15m)
    {
        $this->vol15m = $vol15m;

        return $this;
    }

    /**
     * Get vol15m
     *
     * @return int
     */
    public function getVol15m()
    {
        return $this->vol15m;
    }

    /**
     * Set tcount15m
     *
     * @param integer $tcount15m
     *
     * @return MainMinutePrev
     */
    public function setTcount15m($tcount15m)
    {
        $this->tcount15m = $tcount15m;

        return $this;
    }

    /**
     * Get tcount15m
     *
     * @return int
     */
    public function getTcount15m()
    {
        return $this->tcount15m;
    }
}

