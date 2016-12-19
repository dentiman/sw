<?php

namespace ConsoleBundle\Utils\EarningParsers;


class ChameleonParser extends BaseParser
{
    /**
     * @param \DateTime $datetime
     * @return string
     */
    protected function getContent(\DateTime $datetime){


        $url  = 'https://marketchameleon.com/Calendar/EarningsInnerData?d='.$datetime->format('Ymd');

        $c = $this->curl($url);

        $c = json_decode($c, true);
        $str = '';
        foreach ($c as $data) {
            if($data['ConfCallStr'] != '') {
                $str .=  $data['Symbol'] . ',' .
                    $datetime->format('Y-m-d') . ',' .
                    strtolower($data['TimeStrShort']). ',' .
                    ",,,\r\n";
            }
        }

        return $str;
    }


    protected function curl($url){

            $curl=curl_init();
            curl_setopt ($curl,CURLOPT_URL,$url);
            curl_setopt ($curl,CURLOPT_HEADER,0);
            ob_start();
            curl_exec ($curl);
            curl_close ($curl);
            return ob_get_clean();
    }


}