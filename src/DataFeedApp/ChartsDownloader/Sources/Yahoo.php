<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 12:32
 */

namespace DataFeedApp\ChartsDownloader\Sources;


class Yahoo extends BaseFeed
{
    /** bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    public function getBars()
    {
        $B = false;
        if ($this->tf == 'd' || $this->tf == 'w') {

            $urle = 'http://ichart.yahoo.com/table.csv?s=' .
                $this->ticker .
                '&a=' . (date('m', $this->startTime) * 1 - 1) .
                '&b=' . (date('d', $this->startTime)) .
                '&c=' . (date('Y', $this->startTime)) .
                '&d=' . (date('m', $this->finishTime * 1 + 60 * 60 * 2) * 1 - 1) .
                '&e=' . (date('d', $this->finishTime)) .
                '&f=' . (date('Y', $this->finishTime)) .
                '&g=' . $this->tf . '&ignore=.csv';

            if ($str = @file_get_contents($urle)) {

                $str = trim(str_replace("Date,Open,High,Low,Close,Volume,Adj Close\n", '', $str));
                $rows = explode("\n", $str);
                foreach ($rows as $row) {

                    $field = explode(",", $row);
                    if ($field[4] != 0) {
                        $k = $field[6] / $field[4];
                    } else {
                        $k = 1;
                    }
                    $B['t'][] = strtotime($field[0] );
                    $B['c'][] = round($field[6] * 1, 2);
                    $B['o'][] = round($field[1] * $k, 2);
                    $B['h'][] = round($field[2] * $k, 2);
                    $B['l'][] = round($field[3] * $k, 2);
                    $B['v'][] = $field[5] * 1;
                }
                $B['source'] = 'y';
            }

        }
        return $B;
    }
}