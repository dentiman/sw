<?php
//require_once '../src/ChartsFeed/IqFeed.php';

require __DIR__.'/../vendor/autoload.php';

use DataFeedApp\ChartBuilder\Builder;

$r= new Builder();

var_dump($r->getSettings());


//
//echo $r->getContent('/connector/finviz.php?v=152&&c=1,3,4,5,6,7,8,16,24,25,26,30,31,42,43,44,45,46,49,52,53,54,55,56,57,58,63');