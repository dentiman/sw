<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 12:32
 */

namespace DataFeedApp\ChartsDownloader\Sources;


use DataFeedApp\RemoteServerConnector;

class IqFeed extends BaseFeed
{
    /** bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    public function getBars()
    {
        $connector = new RemoteServerConnector();

        $content = $connector->getIqFeedBars($this->ticker,$this->tf,$this->startTime,$this->finishTime);

        if ($content && $content != '0') {

            $B = [];
            $pocha = array('1'=> 931,'2'=>932,'3'=>933,'5'=>935,'15'=>945,'30'=>1000,'60'=>959);
            $kine = array('1'=> 1601,'2'=>1602,'3'=>1603,'5'=>1605,'15'=>1615,'30'=>1630,'60'=>1700);


            $rows = explode("\r\n", trim($content));
            if(count($rows)>1) {
                foreach ($rows as $row) {

                    $field = explode(',', trim($row));

                    if ($this->tf == 'd' || $this->tf == 'w') {

                        $B['t'][] =  strtotime( $field[0]);
                        $B['c'][] =  $field[4] * 1;
                        $B['o'][] =  $field[3] * 1;
                        $B['h'][] =  $field[1] * 1;
                        $B['l'][] =  $field[2] * 1;
                        $B['v'][] =  $field[5] * 1;
                    } else {

                        $new_time = strtotime($field[0])-($this->tf*60);

                        if (
                            $this->premarket == false &&
                            (   date('Hi',$new_time)*1 >= 1600 ||
                                date('Hi',$new_time)*1 < 930 )
                        ) continue;

                        // $B['t'][] = strtotime( $field[0]);
                         //  $B['t'][] = floor(strtotime($field[0])/100)*100;
                        $B['t'][] = $new_time;
                        $B['c'][] =  $field[4] * 1;
                        $B['o'][] =  $field[3] * 1;
                        $B['h'][] =  $field[1] * 1;
                        $B['l'][] =  $field[2] * 1;
                        $B['v'][] =  $field[6] * 1;

                    }
                }
                $B['source'] = 'i';
                return $B;
            }
        }
        return false;
    }
}