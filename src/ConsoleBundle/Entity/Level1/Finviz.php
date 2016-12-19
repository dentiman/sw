<?php

namespace ConsoleBundle\Entity\Level1;

use Doctrine\ORM\Mapping as ORM;

/**
 * Finviz
 *
 * @ORM\Table(name="feed_level1_finviz")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Level1\FinvizRepository")
 */
class Finviz
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
     * @ORM\Column(name="chp", type="float", nullable=true)
     */
    private $chp;


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

