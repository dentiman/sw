<?php

namespace ConsoleBundle\Entity\Basic;

use Doctrine\ORM\Mapping as ORM;

/**
 * IpoDate
 *
 * @ORM\Table(name="feed_basic_ipo_date")
 * @ORM\Entity(repositoryClass="ConsoleBundle\Repository\Basic\IpoDateRepository")
 */
class IpoDate
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
     * @return IpoDate
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Set ipo
     *
     * @param \DateTime $ipo
     *
     * @return IpoDate
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

