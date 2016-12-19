<?php

namespace ConsoleBundle\Utils\EarningParsers;


class ZackParser extends BaseParser
{

    /**
     * @param \DateTime $datetime
     * @return string
     */
    protected function getContent(\DateTime $datetime){

       $date =  $datetime->format('Y-m-d');

        $url = 'http://www.zacks.com/includes/classes/z2_class_calendarfunctions_data.php?calltype=eventscal&date=' .
            strtotime($date . ' 05:00:00') . '&type=1';


        $c = json_decode(@file_get_contents($url), true);
        $str = '';

        if (isset($c['data'])) {
            foreach ($c['data'] as $data) {

                if ($surp = $this->getTextBetweenTags($data[6], 'div')) {
                    $surp = explode(" ", $surp);
                    $surp_d = $surp[0];
                    $surp_p = str_replace(array('(', ')', '%'), '', $surp[1]);
                } else {
                    $surp_d = '';
                    $surp_p = '';
                }


                $str .= $this->getTextBetweenTags($data[0], 'span') . ',' . //ticker
                    $date . ',' . //date YYYY-MM-DD
                    $data[3] . ',' .//time
                    str_replace('$', '', $data[5]) . ',' . //eps report
                    str_replace('$', '', $data[4]) . ',' . //eps est
                    $surp_d . ',' .//surprise $
                    $surp_p .  //surprise
                    "\r\n";
            }
        }

        $str = str_replace('--', '', $str);

        return $str;
    }

    protected function getTextBetweenTags($string, $tagname)
    {
        $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
        preg_match($pattern, $string, $matches);

        if ($matches) {
            return $matches[1];
        } else {
            return false;
        }

    }
}