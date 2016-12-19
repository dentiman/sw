<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 13.12.16
 * Time: 14:29
 */

namespace ConsoleBundle\Utils\EarningParsers;


abstract class BaseParser implements EarningParser
{
    /**
     * @param integer $days
     * @return string
     */
    public function parse($days)
    {
        $str = '';

        if($days>=0) {
            $start = 0; $end = $days;  $day = new \DateTime();
        } else {
            $start = $days; $end = 0;  $day = new \DateTime('-'.($days*-1).' day');
        }


        for ($i = $start; $i <= $end; $i++) {

            $str .= $this->getContent($day);
            $day->modify('+1 day');
        }

        return $str;
    }

    /**
     * @param \DateTime $datetime
     */
    protected function getContent(\DateTime $datetime){
        return ;
    }
}