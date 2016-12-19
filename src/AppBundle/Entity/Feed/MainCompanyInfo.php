<?php

namespace AppBundle\Entity\Feed;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainCompanyInfo
 *
 * @ORM\Table(name="feed_main_company_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Feed\MainCompanyInfoRepository")
 */
class MainCompanyInfo
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="e", type="integer", nullable=true)
     */
    private $e;

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
     * @var int
     *
     * @ORM\Column(name="i", type="integer", nullable=true)
     */
    private $i;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ipo", type="date", nullable=true)
     */
    private $ipo;


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
     * @return MainCompanyInfo
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return MainCompanyInfo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set e
     *
     * @param integer $e
     *
     * @return MainCompanyInfo
     */
    public function setE($e)
    {
        $this->e = $e;

        return $this;
    }

    /**
     * Get e
     *
     * @return int
     */
    public function getE()
    {
        return $this->e;
    }

    /**
     * Set sec
     *
     * @param string $sec
     *
     * @return MainCompanyInfo
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
     * @return MainCompanyInfo
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
     * @return MainCompanyInfo
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
     * @return MainCompanyInfo
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
     * Set ipo
     *
     * @param \DateTime $ipo
     *
     * @return MainCompanyInfo
     */
    public function setIpo($ipo)
    {
        $this->ipo = $ipo;

        return $this;
    }

    /**
     * Get ipo
     *
     * @return \DateTime
     */
    public function getIpo()
    {
        return $this->ipo;
    }
}

