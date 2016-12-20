<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 12:32
 */

namespace DataFeedApp\ChartsDownloader\Sources;


class FileFeed extends BaseFeed
{
    /** bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    public function getBars()
    {
        if ($str = @file_get_contents(__DIR__."/../../../DataFeedApp/Filefeed/".$this->tf."/" . $this->ticker . ".txt")) {

            if (strlen($str) > 1) {
                $B = @json_decode($str, true);

                $B['source'] = 'f';
                return $B;
            }
        }
        return false;
    }
}