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

    public $startTime;

    public $finishTime;

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
     * @return $this
     */
    public function setTimeRange()
    {
        //количество дней для выборки в зависимости от  таймфрейма
        $timeRange = [
            1 => 2,
            2 => 4,
            3 => 5,
            5 => 15,
            15 => 30,
            30 => 30,
            60 => 60,
            'd' => 365,
            'w' => 365*3,
        ];
        if (is_numeric($this->tf)) {

            $this->finishTime =floor(time()/($this->tf*60))*($this->tf*60);
            $this->startTime = floor((time()-($timeRange[$this->tf]*60*60*24))/($this->tf*60)) * ($this->tf*60);
        } else {
            $this->finishTime = time();
            $this->startTime = time()-($timeRange[$this->tf]*60*60*24);
        }

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
        if (is_numeric($tf)) {
            $this->tf = $tf + 0;
        } else {
            $this->tf = $tf;
        }

        return $this;
    }




    public function getBars()
    {

    }
}