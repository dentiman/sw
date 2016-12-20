<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.12.16
 * Time: 12:32
 */

namespace DataFeedApp\ChartsDownloader\Sources;


class Google extends BaseFeed
{
    /** bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    public function getBars()
    {
        $pocha = array('1'=> 930,'2'=>930,'3'=>930,'5'=>930,'15'=>930,'30'=>930,'60'=>930,'d'=>0,'w'=>0);
        $kine = array('1'=> 1600,'2'=>1600,'3'=>1600,'5'=>1600,'15'=>1600,'30'=>1600,'60'=>1600,'d'=>0,'w'=>0);

         $tf = [
            '1'=>[60,'2d'],
            '2'=>[120,'5d'],
            '3'=>[180,'5d'],
            '5'=>[300,'15d'],
            '15'=>[900,'15d'],
            '30'=>[1800,'30d'],
            '60'=>[3600,'30d'],
            'd'=>[86400,'2Y'],
            'w'=>[604800,'6Y'],
        ];


        $str = @file_get_contents('http://www.google.com/finance/getprices?q=' .
            $this->ticker .
            '&i=' . $tf[$this->tf][0] .
            '&p=' .  $tf[$this->tf][1] . '&f=d,o,h,l,c,v');

        $rows = explode("\n", trim($str));
        $rows = array_slice($rows, 7);
        $startdate = 0;
        $B = ['t'=>[],'c'=>[],'o'=>[],'h'=>[],'l'=>[],'v'=>[]];
        foreach ($rows as $n => $val) {

            $field = explode(",", $val);

            if(count($field)>=5) {
                $pos = strlen($field[0]);
                if ($pos > 5) {
                    $time = str_replace('a', '', $field[0]);
                    $startdate = $time;
                } else {
                    $time = 1 * $startdate + $field[0] * $tf[$this->tf][0];
                }
                if ($this->tf != 'd' && $this->tf != 'w') {
                    $time = $time - 60 * $this->tf;
                }

                if ($this->tf !='d' && $this->tf !='w' && $this->premarket != true &&
                    (date('Hi', $time) * 1 >= $kine[$this->tf] || date('Hi', $time) * 1 < $pocha[$this->tf])) continue;

                if ($field[2] * 1 == 0) {
                    $field[2] = $field[1];
                }
                if ($field[3] * 1 == 0) {
                    $field[3] = $field[1];
                }
                if ($field[4] * 1 == 0) {
                    $field[4] = $field[1];
                }

                $B['t'][] = $time;
                $B['c'][] = $field[1];
                $B['o'][] = $field[4];
                $B['h'][] = $field[2];
                $B['l'][] = $field[3];
                $B['v'][] = $field[5];
            }
        }


        if(count($B['t'])>1){

            $B['source'] = 'g';
            $B['t'] = array_reverse($B['t']);
            $B['c'] = array_reverse($B['c']);
            $B['o'] = array_reverse($B['o']);
            $B['h'] = array_reverse($B['h']);
            $B['l'] = array_reverse($B['l']);
            $B['v'] = array_reverse($B['v']);
            return $B;
        }

        return false;
    }
}