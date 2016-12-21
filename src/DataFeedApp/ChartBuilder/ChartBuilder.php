<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 21.12.16
 * Time: 20:40
 */

namespace DataFeedApp\ChartBuilder;


class ChartBuilder
{
    protected $img;
    protected $settings = [
        't' => 'WINS',
        'tf' => 'd',
        'w' => '700',
        'h' => '300',
        'vol_wdt' => '40',
        'bgcolor' => 'rgb(255,255,255)',
        'setka' => 'rgb(227,227,227)',
        'prem' => '1',
        'voll' => '1',
        'spy_on' =>
            [
                'check' => '1',
                'color' => 'rgb(0,0,0)'
            ],
        'type' => 'candle',
        'barw' => '4',
        'thick' => '0',
        'kontur' => '1',
        'vol_b_w' => '4',
        'colorup' => 'rgb(0,242,10)',
        'colordown' => 'rgb(250,15,0)',
        'fcolorup' => 'rgb(0,0,0)',
        'fcolord' => 'rgb(0,0,0)',
        'vol_c_u' => 'rgb(0,212,85)',
        'vol_c_d' => 'rgb(242,15,0)',
        'sma1' => [
            'color' => 'rgb(181,181,181)',
            'choice' => '10'
        ],
        'sma2' =>
            [
                'color' => 'rgb(219,219,219)',
                'choice' => '10'
            ],
        'sma3' =>
            [
                'color' => 'rgb(199,199,199)',
                'choice' => '10'
            ],
        'ema1' =>
            [
                'color' => 'rgb(191,191,191)',
                'choice' => '10'
            ],
        'ema2' =>
            [
                'color' => 'rgb(191,191,191)',
                'choice' => '10'
            ],
        'ema3' =>
            [
                'color' => 'rgb(196,196,196)',
                'choice' => '10'
            ],
        'mav' => '0',
        'mat' => '1',
        'lines_op' =>
            [
                'check' => '1',
                'color' => 'rgb(214,22,22)'
            ],
        'lines_hi' =>
            [
                'check' => '1',
                'color' => 'rgb(173,20,20)'
            ],
        'lines_lo' =>
            [
                'check' => '1',
                'color' => 'rgb(209,124,25)'
            ],
        'lines_cl' =>
            [
                'check' => '1',
                'color' => 'rgb(148,47,25)'
            ],
        'lines_last' =>
            [
                'check' => '1',
                'color' => 'rgb(209,96,32)'
            ],
        'lines_d' => '1',
    ];

    protected $right_padding =40;
    protected $bottom_padding =40;

    public function __construct()
    {
        parse_str($_SERVER['QUERY_STRING'],$settings);
        $this->settings = array_merge($this->settings,$settings);

        $this->img =  imagecreatetruecolor($this->settings['w'], $this->settings['h']);

        $this->setBackground();
        $this->addChart();
    }

    /**
     * @param $rgb
     * @return bool|int
     */
    public function getImageColor($rgb){

        $rgb = explode(',',str_replace(['rgb(',')'],'',$rgb));

        if(count($rgb)==3){
            return  imagecolorallocate($this->img, $rgb[0], $rgb[1],$rgb[2]);
        }
        return false;
    }


    protected function setBackground(){
        $transparent = imagecolorallocate($this->img, 196, 196, 196);

     //   $trans = imagecolortransparent($this->img, $transparent);
        imagefill($this->img, 0, 0, $transparent);
    }

    public function addChart(){

        imagefilledrectangle(
            $this->img,
            1,
            1,
            $this->settings['w'] - $this->right_padding,
            $this->settings['h'] - $this->bottom_padding,
            $this->getImageColor($this->settings['bgcolor'])
        );
    }
    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    public function output() {
        header("Content-Type: image/png");
        imagepng($this->img);
    }



}