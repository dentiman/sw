<?php
//require_once '../src/ChartsFeed/IqFeed.php';

require __DIR__.'/../vendor/autoload.php';

date_default_timezone_set('America/New_York');


use DataFeedApp\ChartBuilder\ChartBuilder;

$r= new ChartBuilder();


$r->output();