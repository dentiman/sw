<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 22.12.16
 * Time: 11:44
 */

namespace DataFeedApp\ChartBuilder;


use DataFeedApp\ChartsDownloader\Sources\Google;

class ChartDataFeeder
{
    public $o;

    public $h;

    public $l;

    public $c;

    public $v;

    public $t;

    public $source;

    public $max_price;

    public $min_price;

    public $price_range;

    public $max_volume;



    public function loadData($ticker,$tf){

        $downloader = new Google();
        $downloader->setTicker($ticker)
            ->setTf($tf)
            ->setStartTime(time() - 60 * 60 * 365 * 24)
            ->setFinishTime(time());

        $data = $downloader->getBars();

        if($data) {
            $this->o = $data['o'];
            $this->h = $data['h'];
            $this->l = $data['l'];
            $this->c = $data['c'];
            $this->v = $data['v'];
            $this->t = $data['t'];
            $this->source = $data['source'];
            $this->max_price = max($data['h']);
            $this->min_price = min($data['l']);
            $this->price_range = $this->max_price - $this->min_price;
            $this->max_price = $this->max_price + $this->price_range/26;
            $this->max_volume = max($data['v']);
        }

        return $this;
    }




}