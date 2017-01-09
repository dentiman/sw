<?php
//require_once '../src/ChartsFeed/IqFeed.php';

require __DIR__.'/../vendor/autoload.php';

date_default_timezone_set('America/New_York');


use DataFeedApp\ChartBuilder\ChartBuilder;

$r= new ChartBuilder();

//var_dump($r->getFeed()->labels2);
//echo $r->getFeed()->price_range." ";
//echo $r->getFeed()->min_price." ";
//echo $r->getFeed()->max_price." ";

//echo $r->getFeed()->test;

var_dump($r->getFeed()->getTimes());