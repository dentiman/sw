<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 22.12.16
 * Time: 11:44
 */

namespace DataFeedApp\ChartBuilder;


use DataFeedApp\ChartsDownloader\Sources\Google;
use DataFeedApp\ChartsDownloader\Sources\IqFeed;

class ChartDataFeeder
{
    public $o;

    public $h;

    public $l;

    public $c;

    public $v;

    public $t;


    public $source = false;

    public $max_price;

    public $min_price;

    public $price_range;

    public $max_volume;




    public function loadData($settings,$bars_count)
    {
        $downloader = new IqFeed();
        $downloader->setTicker($settings['t'])
            ->setTf($settings['tf'])
            ->setPremarket($settings['prem'])
            ->setTimeRange();

        $data = $downloader->getBars();

        $this->o = $data['o'];
        $this->h = $data['h'];
        $this->l = $data['l'];
        $this->c = $data['c'];
        $this->v = $data['v'];
        $this->t = $data['t'];
        $this->source = $data['source'];



    }

    public function calculate($bars_count)
    {
        //обрезка данных под график
        $this->t = array_slice($this->t, 0, $bars_count);
        $this->o = array_slice($this->o, 0, $bars_count);
        $this->h = array_slice($this->h, 0, $bars_count);
        $this->l = array_slice($this->l, 0, $bars_count);
        $this->c = array_slice($this->c, 0, $bars_count);
        $this->v = array_slice($this->v, 0, $bars_count);


        $this->max_price = max($this->h);
        $this->min_price = min($this->l);
        $this->price_range = $this->max_price - $this->min_price;
        $this->max_price = $this->max_price + $this->price_range/26;
        $this->max_volume = max($this->v);
    }

    public function getTimes() {
        $A= [];
        foreach ($this->t as $time) {
            $A[] = [ date('Y-m-d H:i:s',$time),$time];
        }
        return $A;
    }



}