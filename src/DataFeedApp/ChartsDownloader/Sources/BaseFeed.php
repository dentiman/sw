<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 12:24
 */

namespace DataFeedApp\ChartsDownloader\Sources;



abstract class BaseFeed implements SourcesDataFeedInterface
{
    protected $ticker = '';

    protected $marketOpen = false;

    protected $startTime;

    protected $finishTime;

    protected $premarket = false;

    protected $tf = 'd';

    /**
     * @param $ticker
     * @return $this
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * @param boolean $marketOpen
     * @return $this
     */
    public function setMarketOpen($marketOpen)
    {
        $this->marketOpen = $marketOpen;
        return $this;
    }

    /**
     * @param mixed $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @param mixed $finishTime
     * @return $this
     */
    public function setFinishTime($finishTime)
    {
        $this->finishTime = $finishTime;
        return $this;
    }

    /**
     * @param boolean $premarket
     * @return $this
     */
    public function setPremarket($premarket)
    {
        $this->premarket = $premarket;
        return $this;
    }

    /**
     * @param string $tf
     * @return $this
     */
    public function setTf($tf)
    {
        $this->tf = $tf;
        return $this;
    }




    public function getBars()
    {

    }
}