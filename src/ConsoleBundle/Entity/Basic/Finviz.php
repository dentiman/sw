<?php

namespace ConsoleBundle\Entity\Basic;

use Doctrine\ORM\Mapping as ORM;

/**
 * Finviz
 *
 * @ORM\Table(name="feed_basic_finviz")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Basic\FinvizRepository")
 *
 */
class Finviz
{
    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=10, nullable=true)
     * @ORM\Id
     *
     */
    private $ticker;


    /**
     * @var string
     *
     * @ORM\Column(name="sec", type="string", length=255, nullable=true)
     */
    private $sec;

    /**
     * @var string
     *
     * @ORM\Column(name="ind", type="string", length=255, nullable=true)
     */
    private $ind;

    /**
     * @var string
     *
     * @ORM\Column(name="coun", type="string", length=255, nullable=true)
     */
    private $coun;


    /**
     * @var float
     *
     * @ORM\Column(name="mc", type="float", nullable=true)
     */
    private $mc;

    /**
     * @var float
     *
     * @ORM\Column(name="pe", type="float", nullable=true)
     */
    private $pe;

    /**
     * @var float
     *
     * @ORM\Column(name="fpe", type="float", nullable=true)
     */
    private $fpe;

    /**
     * @var float
     *
     * @ORM\Column(name="epsf", type="float", nullable=true)
     */
    private $epsf;

    /**
     * @var float
     *
     * @ORM\Column(name="aut", type="float", nullable=true)
     */
    private $aut;

    /**
     * @var float
     *
     * @ORM\Column(name="sfloat", type="float", nullable=true)
     */
    private $sfloat;

    /**
     * @var float
     *
     * @ORM\Column(name="insider", type="float", nullable=true)
     */
    private $insider;

    /**
     * @var float
     *
     * @ORM\Column(name="fshort", type="float", nullable=true)
     */
    private $fshort;

    /**
     * @var float
     *
     * @ORM\Column(name="shratio", type="float", nullable=true)
     */
    private $shratio;

    /**
     * @var float
     *
     * @ORM\Column(name="pw", type="float", nullable=true)
     */
    private $pw;

    /**
     * @var float
     *
     * @ORM\Column(name="pm", type="float", nullable=true)
     */
    private $pm;

    /**
     * @var float
     *
     * @ORM\Column(name="pq", type="float", nullable=true)
     */
    private $pq;

    /**
     * @var float
     *
     * @ORM\Column(name="ph", type="float", nullable=true)
     */
    private $ph;

    /**
     * @var float
     *
     * @ORM\Column(name="py", type="float", nullable=true)
     */
    private $py;

    /**
     * @var float
     *
     * @ORM\Column(name="atr", type="float", nullable=true)
     */
    private $atr;

    /**
     * @var float
     *
     * @ORM\Column(name="sma20pc", type="float", nullable=true)
     */
    private $sma20pc;

    /**
     * @var float
     *
     * @ORM\Column(name="sma50pc", type="float", nullable=true)
     */
    private $sma50pc;

    /**
     * @var float
     *
     * @ORM\Column(name="sma200pc", type="float", nullable=true)
     */
    private $sma200pc;

    /**
     * @var float
     *
     * @ORM\Column(name="hi50pc", type="float", nullable=true)
     */
    private $hi50pc;

    /**
     * @var float
     *
     * @ORM\Column(name="lo50pc", type="float", nullable=true)
     */
    private $lo50pc;

    /**
     * @var float
     *
     * @ORM\Column(name="hi52pc", type="float", nullable=true)
     */
    private $hi52pc;

    /**
     * @var float
     *
     * @ORM\Column(name="lo52pc", type="float", nullable=true)
     */
    private $lo52pc;



    /**
     * @var float
     *
     * @ORM\Column(name="avvo", type="float", nullable=true)
     */
    private $avvo;


    /**
     * @var int
     *
     * @ORM\Column(name="i", type="integer", nullable=true)
     */
    private $i;

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
     * @return Finviz
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }


    /**
     * Set sec
     *
     * @param string $sec
     *
     * @return Finviz
     */
    public function setSec($sec)
    {
        $this->sec = $sec;

        return $this;
    }

    /**
     * Get sec
     *
     * @return string
     */
    public function getSec()
    {
        return $this->sec;
    }

    /**
     * Set ind
     *
     * @param string $ind
     *
     * @return Finviz
     */
    public function setInd($ind)
    {
        $this->ind = $ind;

        return $this;
    }

    /**
     * Get ind
     *
     * @return string
     */
    public function getInd()
    {
        return $this->ind;
    }

    /**
     * Set coun
     *
     * @param string $coun
     *
     * @return Finviz
     */
    public function setCoun($coun)
    {
        $this->coun = $coun;

        return $this;
    }

    /**
     * Get coun
     *
     * @return string
     */
    public function getCoun()
    {
        return $this->coun;
    }

    /**
     * Set i
     *
     * @param integer $i
     *
     * @return Finviz
     */
    public function setI($i)
    {
        $this->i = $i;

        return $this;
    }

    /**
     * Get i
     *
     * @return int
     */
    public function getI()
    {
        return $this->i;
    }

    /**
     * Set mc
     *
     * @param float $mc
     *
     * @return Finviz
     */
    public function setMc($mc)
    {
        $this->mc = $mc;

        return $this;
    }

    /**
     * Get mc
     *
     * @return float
     */
    public function getMc()
    {
        return $this->mc;
    }

    /**
     * Set pe
     *
     * @param float $pe
     *
     * @return Finviz
     */
    public function setPe($pe)
    {
        $this->pe = $pe;

        return $this;
    }

    /**
     * Get pe
     *
     * @return float
     */
    public function getPe()
    {
        return $this->pe;
    }

    /**
     * Set fpe
     *
     * @param float $fpe
     *
     * @return Finviz
     */
    public function setFpe($fpe)
    {
        $this->fpe = $fpe;

        return $this;
    }

    /**
     * Get fpe
     *
     * @return float
     */
    public function getFpe()
    {
        return $this->fpe;
    }

    /**
     * Set epsf
     *
     * @param float $epsf
     *
     * @return Finviz
     */
    public function setEpsf($epsf)
    {
        $this->epsf = $epsf;

        return $this;
    }

    /**
     * Get epsf
     *
     * @return float
     */
    public function getEpsf()
    {
        return $this->epsf;
    }

    /**
     * Set aut
     *
     * @param float $aut
     *
     * @return Finviz
     */
    public function setAut($aut)
    {
        $this->aut = $aut;

        return $this;
    }

    /**
     * Get aut
     *
     * @return float
     */
    public function getAut()
    {
        return $this->aut;
    }

    /**
     * Set sfloat
     *
     * @param float $sfloat
     *
     * @return Finviz
     */
    public function setSfloat($sfloat)
    {
        $this->sfloat = $sfloat;

        return $this;
    }

    /**
     * Get sfloat
     *
     * @return float
     */
    public function getSfloat()
    {
        return $this->sfloat;
    }

    /**
     * Set insider
     *
     * @param float $insider
     *
     * @return Finviz
     */
    public function setInsider($insider)
    {
        $this->insider = $insider;

        return $this;
    }

    /**
     * Get insider
     *
     * @return float
     */
    public function getInsider()
    {
        return $this->insider;
    }

    /**
     * Set fshort
     *
     * @param float $fshort
     *
     * @return Finviz
     */
    public function setFshort($fshort)
    {
        $this->fshort = $fshort;

        return $this;
    }

    /**
     * Get fshort
     *
     * @return float
     */
    public function getFshort()
    {
        return $this->fshort;
    }

    /**
     * Set shratio
     *
     * @param float $shratio
     *
     * @return Finviz
     */
    public function setShratio($shratio)
    {
        $this->shratio = $shratio;

        return $this;
    }

    /**
     * Get shratio
     *
     * @return float
     */
    public function getShratio()
    {
        return $this->shratio;
    }

    /**
     * Set pw
     *
     * @param float $pw
     *
     * @return Finviz
     */
    public function setPw($pw)
    {
        $this->pw = $pw;

        return $this;
    }

    /**
     * Get pw
     *
     * @return float
     */
    public function getPw()
    {
        return $this->pw;
    }

    /**
     * Set pm
     *
     * @param float $pm
     *
     * @return Finviz
     */
    public function setPm($pm)
    {
        $this->pm = $pm;

        return $this;
    }

    /**
     * Get pm
     *
     * @return float
     */
    public function getPm()
    {
        return $this->pm;
    }

    /**
     * Set pq
     *
     * @param float $pq
     *
     * @return Finviz
     */
    public function setPq($pq)
    {
        $this->pq = $pq;

        return $this;
    }

    /**
     * Get pq
     *
     * @return float
     */
    public function getPq()
    {
        return $this->pq;
    }

    /**
     * Set ph
     *
     * @param float $ph
     *
     * @return Finviz
     */
    public function setPh($ph)
    {
        $this->ph = $ph;

        return $this;
    }

    /**
     * Get ph
     *
     * @return float
     */
    public function getPh()
    {
        return $this->ph;
    }

    /**
     * Set py
     *
     * @param float $py
     *
     * @return Finviz
     */
    public function setPy($py)
    {
        $this->py = $py;

        return $this;
    }

    /**
     * Get py
     *
     * @return float
     */
    public function getPy()
    {
        return $this->py;
    }

    /**
     * Set atr
     *
     * @param float $atr
     *
     * @return Finviz
     */
    public function setAtr($atr)
    {
        $this->atr = $atr;

        return $this;
    }

    /**
     * Get atr
     *
     * @return float
     */
    public function getAtr()
    {
        return $this->atr;
    }

    /**
     * Set sma20pc
     *
     * @param float $sma20pc
     *
     * @return Finviz
     */
    public function setSma20pc($sma20pc)
    {
        $this->sma20pc = $sma20pc;

        return $this;
    }

    /**
     * Get sma20pc
     *
     * @return float
     */
    public function getSma20pc()
    {
        return $this->sma20pc;
    }

    /**
     * Set sma50pc
     *
     * @param float $sma50pc
     *
     * @return Finviz
     */
    public function setSma50pc($sma50pc)
    {
        $this->sma50pc = $sma50pc;

        return $this;
    }

    /**
     * Get sma50pc
     *
     * @return float
     */
    public function getSma50pc()
    {
        return $this->sma50pc;
    }

    /**
     * Set sma200pc
     *
     * @param float $sma200pc
     *
     * @return Finviz
     */
    public function setSma200pc($sma200pc)
    {
        $this->sma200pc = $sma200pc;

        return $this;
    }

    /**
     * Get sma200pc
     *
     * @return float
     */
    public function getSma200pc()
    {
        return $this->sma200pc;
    }


    /**
     * Set hi52pc
     *
     * @param float $hi52pc
     *
     * @return Finviz
     */
    public function setHi52pc($hi52pc)
    {
        $this->hi52pc = $hi52pc;

        return $this;
    }

    /**
     * Get hi52pc
     *
     * @return float
     */
    public function getHi52pc()
    {
        return $this->hi52pc;
    }

    /**
     * Set lo52pc
     *
     * @param float $lo52pc
     *
     * @return Finviz
     */
    public function setLo52pc($lo52pc)
    {
        $this->lo52pc = $lo52pc;

        return $this;
    }

    /**
     * Get lo52pc
     *
     * @return float
     */
    public function getLo52pc()
    {
        return $this->lo52pc;
    }


    /**
     * Set hi50pc
     *
     * @param float $hi50pc
     *
     * @return Finviz
     */
    public function setHi50pc($hi50pc)
    {
        $this->hi50pc = $hi50pc;

        return $this;
    }

    /**
     * Get hi50pc
     *
     * @return float
     */
    public function getHi50pc()
    {
        return $this->hi50pc;
    }

    /**
     * Set lo50pc
     *
     * @param float $lo50pc
     *
     * @return Finviz
     */
    public function setLo50pc($lo50pc)
    {
        $this->lo50pc = $lo50pc;

        return $this;
    }

    /**
     * Get lo50pc
     *
     * @return float
     */
    public function getLo50pc()
    {
        return $this->lo50pc;
    }

    /**
     * Set avvo
     *
     * @param float $avvo
     *
     * @return Finviz
     */
    public function setAvvo($avvo)
    {
        $this->avvo = $avvo;

        return $this;
    }

    /**
     * Get avvo
     *
     * @return float
     */
    public function getAvvo()
    {
        return $this->avvo;
    }
}

