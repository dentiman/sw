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

    public $labels;

    public $labels2;

    public $source = false;

    public $max_price;

    public $min_price;

    public $price_range;

    public $max_volume;

    public $lines;

    public $MA = [];





    public function loadData($settings,$bars_count)
    {

        $downloader = new Google();
        $downloader->setTicker($settings['t'])
            ->setTf($settings['tf'])
            ->setStartTime(time() - 60 * 60 * 365 * 24)
            ->setFinishTime(time());

        $data = $downloader->getBars();

        if($data) {

            $days = []; $key = 0;
            foreach ($data['t'] as $timestamp) {

                // группировка данных по дням для формирования точек линий (open,high,low,close)
                $days[date('Ymd',$timestamp)]['datakey'][] = $key;
                $days[date('Ymd',$timestamp)]['o'][] = $data['o'][$key];
                $days[date('Ymd',$timestamp)]['h'][] = $data['h'][$key];
                $days[date('Ymd',$timestamp)]['l'][] = $data['l'][$key];
                $days[date('Ymd',$timestamp)]['c'][] = $data['c'][$key];

                $prev_timestamp = $timestamp;
                $key++;
            }
            //перебор дней со своими значениями для формирования масива точек линий
            if($settings['tf'] !='d' && $settings['tf'] !='w') {

                $key = 0; $lines =[];
                foreach ($days as $date => $val) {

                    $keys = [ //ключи нужных значений точек в текущем дне
                        'h'=>array_keys($val['h'], max($val['h']))[0],
                        'l'=> array_keys($val['l'], min($val['l']))[0],
                        'o'=>  count($val['o'])-1,
                        'c'=> 0
                    ];

                    //массив точек начала линий со значением цены (x - номер бара по счету с начала)
                    if($settings['lines_hi']['check']) {
                        $lines[] = ['type' => 'hi', 'price'=> $val['h'][$keys['h']],'x'=>$val['datakey'][$keys['h']]];
                    }

                    if($settings['lines_lo']['check']) {
                        $lines[] = ['type' => 'lo','price'=> $val['l'][$keys['l']],'x'=>$val['datakey'][$keys['l']]];
                    }

                    if($settings['lines_op']['check']) {
                        $lines[] = ['type' => 'oo','price'=> $val['o'][$keys['o']],'x'=>$val['datakey'][$keys['o']]];
                    }

                    if($settings['lines_cl']['check']) {
                        $lines[] = ['type' => 'cl','price'=> $val['c'][$keys['c']],'x'=>$val['datakey'][$keys['c']]];
                    }

                    $key++;
                    if($key == $settings['lines_d']) {
                        break;
                    }
                }
                $this->lines =  $lines;
            }



            if(isset($settings['sma1']['choice'])) {

                $this->MA[] = [
                    'name'=>'sma ' . $settings['sma1']['choice'],
                    'data' => $this->getSMA($data['c'],$settings['sma1']['choice'],$bars_count),
                    'color' => $settings['sma1']['color']
                ];
            }

            if(isset($settings['sma2']['choice'])) {

                $this->MA[] = [
                    'name'=>'sma ' . $settings['sma2']['choice'],
                    'data' => $this->getSMA($data['c'],$settings['sma2']['choice'],$bars_count),
                    'color' => $settings['sma2']['color']
                ];
            }

            if(isset($settings['sma3']['choice'])) {

                $this->MA[] = [
                    'name'=>'sma ' . $settings['sma3']['choice'],
                    'data' => $this->getSMA($data['c'],$settings['sma3']['choice'],$bars_count),
                    'color' => $settings['sma3']['color']
                ];
            }

            if(isset($settings['ema1']['choice'])) {

                $this->MA[] = [
                    'name'=>'ema ' . $settings['ema1']['choice'],
                    'data' => $this->getEMA($data['c'],$settings['ema1']['choice'],$bars_count),
                    'color' => $settings['ema1']['color']
                ];
            }

            if(isset($settings['ema2']['choice'])) {

                $this->MA[] = [
                    'name'=>'ema ' . $settings['ema1']['choice'],
                    'data' => $this->getEMA($data['c'],$settings['ema1']['choice'],$bars_count),
                    'color' => $settings['ema1']['color']
                ];
            }

            if(isset($settings['ema3']['choice'])) {

                $this->MA[] = [
                    'name'=>'ema ' . $settings['ema3']['choice'],
                    'data' => $this->getEMA($data['c'],$settings['ema3']['choice'],$bars_count),
                    'color' => $settings['ema3']['color']
                ];
            }

            //обрезка данных под график
            $data['t'] = array_slice($data['t'], 0, $bars_count);
            $data['o'] = array_slice($data['o'], 0, $bars_count);
            $data['h'] = array_slice($data['h'], 0, $bars_count);
            $data['l'] = array_slice($data['l'], 0, $bars_count);
            $data['c'] = array_slice($data['c'], 0, $bars_count);
            $data['v'] = array_slice($data['v'], 0, $bars_count);


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

            $this->addLabels($settings['tf']);

        }
    }

    protected function calculate($settings,$data,$bars_count){



    }


    public function getSMA($data,$period,$bars_count) {
        $A= [];
        $count = count($data)-$period;
        for ($i=0;$i<=$count;$i++) {
            $A[] = round(array_sum(array_slice($data, $i, $period))/$period,2);
        }
        return array_slice($A,0,$bars_count);
    }

    public function getEMA($data,$period,$bars_count) {
        $A= [];
        $data = array_reverse($data);
        for ($i=0;$i<count($data);$i++) {
            if($i==$period-1) {
                $A[] = round(array_sum(array_slice($data,0, $period))/$period,2);
            }
            else { $A[] = $data[$i]*2/($period+1)+end($A)*(1-2/($period+1));}
        }
        return array_slice(array_reverse($A),0,$bars_count);
    }


    protected function addLabels($tf)
    {
        $dateform = array( // формы времни для нижней шкалы под графиком
            '1' => array('H', 'H:i'),
            '2' => array('H', 'H:i'),
            '3' => array('H', 'H:i'),
            '5' => array('d', 'D d M'),
            '15' => array('d', 'D d M'),
            '30' => array('d', 'd M'),
            '60' => array('W', 'd M'),
            'd' => array('M', 'M Y'),
            'w' => array('Y', 'Y')
        );

        $dateform2 = array(// формы времни для верхней шкалы под графиком
            '1' => array('H', 'H:i'),
            '2' => array('H', 'H:i'),
            '3' => array('H', 'H:i'),
            '5' => array('i', 'H:i', '00'),
            '15' => array('i', 'H', '00'),
            '30' => array('d', 'd M'),
            '60' => array('W', 'd M'),
            'd' => array('M', 'M Y'),
            'w' => array('W', '')
        );

        $key = 0;
        $prev_timestamp = $this->t[0];

        foreach ($this->t as $timestamp) {

            //-------------
            if (date($dateform2[$tf][0], $timestamp) == $dateform2[$tf][2] && date('H', $timestamp) != '16') {
              $this->labels2[$key - 1] = date($dateform2[$tf][1], $timestamp);
            }

            //-------------
            if (date($dateform[$tf][0], $prev_timestamp) != date($dateform[$tf][0], $timestamp)) {
                $this->labels[$key - 1] = date($dateform[$tf][1], $prev_timestamp);
            }


            $prev_timestamp = $timestamp;
            $key++;
        }

    }


}