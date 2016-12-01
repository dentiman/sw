<?php

namespace AppBundle\Entity\Feed;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainEarnings
 *
 * @ORM\Table(name="feed_main_earnings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Feed\MainEarningsRepository")
 */
class MainEarnings
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
     * @var \DateTime
     *
     * @ORM\Column(name="earn", type="date")
     */
    private $earn;

    /**
     * @var string
     *
     * @ORM\Column(name="earn_time", type="string", length=255)
     */
    private $earnTime;

    /**
     * @var float
     *
     * @ORM\Column(name="eps", type="float")
     */
    private $eps;

    /**
     * @var float
     *
     * @ORM\Column(name="eps_est", type="float")
     */
    private $epsEst;

    /**
     * @var float
     *
     * @ORM\Column(name="eps_surprise", type="float")
     */
    private $epsSurprise;

    /**
     * @var float
     *
     * @ORM\Column(name="eps_surprise_percent", type="float")
     */
    private $epsSurprisePercent;


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
     * @return MainEarnings
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set earn
     *
     * @param \DateTime $earn
     *
     * @return MainEarnings
     */
    public function setEarn($earn)
    {
        $this->earn = $earn;

        return $this;
    }

    /**
     * Get earn
     *
     * @return \DateTime
     */
    public function getEarn()
    {
        return $this->earn;
    }

    /**
     * Set earnTime
     *
     * @param string $earnTime
     *
     * @return MainEarnings
     */
    public function setEarnTime($earnTime)
    {
        $this->earnTime = $earnTime;

        return $this;
    }

    /**
     * Get earnTime
     *
     * @return string
     */
    public function getEarnTime()
    {
        return $this->earnTime;
    }

    /**
     * Set eps
     *
     * @param float $eps
     *
     * @return MainEarnings
     */
    public function setEps($eps)
    {
        $this->eps = $eps;

        return $this;
    }

    /**
     * Get eps
     *
     * @return float
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Set epsEst
     *
     * @param float $epsEst
     *
     * @return MainEarnings
     */
    public function setEpsEst($epsEst)
    {
        $this->epsEst = $epsEst;

        return $this;
    }

    /**
     * Get epsEst
     *
     * @return float
     */
    public function getEpsEst()
    {
        return $this->epsEst;
    }

    /**
     * Set epsSurprise
     *
     * @param float $epsSurprise
     *
     * @return MainEarnings
     */
    public function setEpsSurprise($epsSurprise)
    {
        $this->epsSurprise = $epsSurprise;

        return $this;
    }

    /**
     * Get epsSurprise
     *
     * @return float
     */
    public function getEpsSurprise()
    {
        return $this->epsSurprise;
    }

    /**
     * Set epsSurprisePercent
     *
     * @param float $epsSurprisePercent
     *
     * @return MainEarnings
     */
    public function setEpsSurprisePercent($epsSurprisePercent)
    {
        $this->epsSurprisePercent = $epsSurprisePercent;

        return $this;
    }

    /**
     * Get epsSurprisePercent
     *
     * @return float
     */
    public function getEpsSurprisePercent()
    {
        return $this->epsSurprisePercent;
    }
}

