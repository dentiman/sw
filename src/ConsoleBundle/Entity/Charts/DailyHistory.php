<?php

namespace ConsoleBundle\Entity\Charts;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyHistory
 *
 * @ORM\Table(name="feed_charts_daily_history")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Charts\DailyHistoryRepository")
 */
class DailyHistory
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=10)
     * @ORM\Id
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

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
     * @ORM\Column(name="lo", type="float")
     */
    private $lo;

    /**
     * @var float
     *
     * @ORM\Column(name="cl", type="float", nullable=true)
     */
    private $cl;

    /**
     * @var int
     *
     * @ORM\Column(name="vol", type="integer", nullable=true)
     */
    private $vol;

    /**
     * @var int
     *
     * @ORM\Column(name="n", type="integer", nullable=true)
     */
    private $n;

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=255)
     */
    private $ticker;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return DailyHistory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return DailyHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set op
     *
     * @param float $op
     *
     * @return DailyHistory
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
     * @return DailyHistory
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
     * @return DailyHistory
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
     * Set cl
     *
     * @param float $cl
     *
     * @return DailyHistory
     */
    public function setCl($cl)
    {
        $this->cl = $cl;

        return $this;
    }

    /**
     * Get cl
     *
     * @return float
     */
    public function getCl()
    {
        return $this->cl;
    }

    /**
     * Set vol
     *
     * @param integer $vol
     *
     * @return DailyHistory
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
     * Set n
     *
     * @param integer $n
     *
     * @return DailyHistory
     */
    public function setN($n)
    {
        $this->n = $n;

        return $this;
    }

    /**
     * Get n
     *
     * @return int
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * Set ticker
     *
     * @param string $ticker
     *
     * @return DailyHistory
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get ticker
     *
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }
}

