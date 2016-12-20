<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 10:19
 */

namespace DataFeedApp\ChartsDownloader\Sources;


interface SourcesDataFeedInterface
{
    public function getBars();
}