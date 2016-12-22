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
        'barw' => 4,
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

    protected $colors = [
        'black_color' => 'rgb(0,0,0)',
    ];

    protected $right_padding =40;//px

    protected $bottom_padding =40;//px

    protected $volume_bars_height = 40;//px

    protected $volume_area_height =0;//px

    protected $price_area_height;//px

    protected $feed;

    protected $bars_count;

    public function __construct()
    {
        parse_str($_SERVER['QUERY_STRING'],$settings);
        $this->settings = array_merge($this->settings,$settings,$this->colors);

        $this->img =  imagecreatetruecolor($this->settings['w'], $this->settings['h']);

        // reformat colors to img format
        foreach ($this->settings as $key => $value) {

            if( is_array($value)) {

                if( isset($value['color']) && strpos($value['color'], 'rgb') === 0 ){

                    $this->settings[$key]['color'] = $this->getImageColor($value['color']);
                }

            } elseif (strpos($value, 'rgb') === 0) {
                $this->settings[$key] = $this->getImageColor($value);
            }
        }

        $this->setCalculation();

        $this->feed = new ChartDataFeeder();

        $this->feed->loadData($this->settings['t'],$this->settings['tf']);

        //  $this->setBackground();
        //   $this->addChart();


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

    /**
     * расчет основных покзателей на основании входящих параметров (настроек графика)
     */
    protected function setCalculation(){

        // separate volume area
        if($this->settings['voll'] == '1') {
            $this->volume_area_height = $this->volume_bars_height;
        }

        //<editor-fold desc="+set price area height">
        if ($this->settings['h'] <= 200) {

           $this->price_area_height = $this->settings['h'] - 30 + $this->volume_area_height + ($this->bottom_padding - 20);
        }
        elseif ($this->settings['h'] > 200 && $this->settings['h'] < 300) {

            $this->price_area_height = $this->settings['h'] - 35 + $this->volume_area_height + ($this->bottom_padding - 20);
        }
        elseif ($this->settings['h'] >= 300 && $this->settings['h'] < 400) {

            $this->price_area_height = $this->settings['h'] - 40 + $this->volume_area_height + ($this->bottom_padding - 20);
        }
        else {
            $this->price_area_height = $this->settings['h']- 50 + $this->volume_area_height + ($this->bottom_padding - 20);
        }
        //</editor-fold>

        $this->bars_count = ceil(($this->settings['w']*1 - 40) / $this->settings['barw']);

    }

    protected function setBackground(){
        $transparent = imagecolorallocate($this->img, 196, 196, 196);

        //$trans = imagecolortransparent($this->img, $transparent);
        imagefill($this->img, 0, 0, $transparent);
    }


    /**
     * Расчет значения на оси У для текущей цены $price
     * @param $price
     * @return float
     */
    protected function getY($price) {

     return ceil(($this->price_area_height)*($this->feed->max_price-1*$price)/$this->feed->price_range);

    }


    protected function drawPolygon($price, $text, $color)
    {
        $price_y = 0;// get_y($price);
        $pol_values = array(
            $this->settings['w'] - 43, $price_y,  // Point 1 (x, y)
            $this->settings['w'] - 34, $price_y + 3, // Point 2 (x, y)
            $this->settings['w'], $price_y + 3,  // Point 3 (x, y)
            $this->settings['w'], $price_y - 4,  // Point 4 (x, y)
            $this->settings['w'] - 34, $price_y - 4
        );

        imagefilledpolygon($this->img, $pol_values, 5, $color);
        imagestring($this->img, 1, $this->settings['w'] - 34, $price_y - 4, $text, $this->settings['black_color']);
    }

    protected function drawMA($price, $price2, $x, $color)
    {

        $y_sma = $this->getY($price);
        $y_sma2 = $this->getY($price2);

        if ($y_sma < $this->settings['h'] - $this->bottom_padding && $y_sma > 5) {

            imageline($this->img, $x - $this->settings['barw'] + 1, $y_sma, $x, $y_sma2, $color);

            if ($this->settings['mat'] == 2) {
                imageline($this->img, $x - $this->settings['barw'] + 1, $y_sma + 1, $x, $y_sma2 + 1, $color);
            }
        }

    }

    function drawVolume($vol, $x, $color)
    {
        $volume = ($this->settings['h'] - $this->bottom_padding) - ceil($vol / ($this->feed->max_volume / $this->settings['vol_wdt']));

        imagefilledrectangle(
            $this->img, $x - ($this->settings['vol_b_w'] - 1) / 2,
            $volume, $x + ($this->settings['vol_b_w'] - 1) / 2,
            $this->settings['h'] - $this->bottom_padding, $color
        );
    }

    function draw_bar($o, $h, $l, $c, $x, $color_arr)
    {                                                                        // ф-я отрисовки БАРОВ
        //расчет координат бара(свечки) на оси Y
        $hight = $this->getY($h);
        $close = $this->getY($c);
        $open = $this->getY($o);
        $low = $this->getY($l);


        $topleft = min($open, $close);
        $butright = max($open, $close);

        imagesetthickness($this->img, $this->settings['thick'] + 1);

        if ($open >= $close) {
            imageline($this->img, $x, $low, $x, $hight, $this->settings['fcolorup']);
            $color = $color_arr['bar']['telo']['up'];
            $ccolor = $color_arr['bar']['fit']['up'];
        } //  рисуем стержень свечки
        else if ($open < $close) {
            imageline($this->img, $x, $low, $x, $hight,$this->settings['fcolord']);
            $color = $color_arr['bar']['telo']['d'];
            $ccolor = $color_arr['bar']['fit']['d'];
        }
        imagesetthickness($this->img, 1);

        if ($type == 'candle') {
            if ($butright - $topleft >= 1) {
                imagerectangle($this->img, $x - $kontur, $topleft, $x + $kontur - $pixel, $butright, $ccolor);
            } // рисуем контур тела свечи
            else if ($butright - $topleft < 1) {
                imagerectangle($this->img, $x - $kontur, $topleft - 1, $x + $kontur - $pixel, $butright + 1, $ccolor);
            }

            if ($butright - $topleft > 1) {
                imagefilledrectangle($this->img, $x - ($kontur - 1), $topleft + 1, $x + ($kontur - 1 - $pixel), $butright - 1, $color);
            } // рисуем тело свечи
            if ($butright - $topleft < 1) {
                imagefilledrectangle($this->img, $x - ($kontur - 1), $topleft, $x + ($kontur - 1 - $pixel), $butright, $color);
            }
        }// Закрашенный прямоугольник


        if ($type == 'bar') {
            if ($open >= $close) {
                imageline($this->img, $x - $plus - 2, $open, $x, $open, $color_arr['bar']['fit']['up']);
                imageline($this->img, $x, $close, $x + 2, $close, $color_arr['bar']['fit']['up']);
                if ($this->settings['thick'] >= 1) {
                    imageline($this->img, $x - $plus - 2, $open + 1, $x, $open + 1, $color_arr['bar']['fit']['up']);
                    imageline($this->img, $x, $close + 1, $x + 2, $close + 1, $color_arr['bar']['fit']['up']);
                }
            }

            if ($open < $close) {
                imageline($this->img, $x - $plus - 2, $open, $x, $open, $color_arr['bar']['fit']['d']);
                imageline($this->img, $x, $close, $x + 2, $close, $color_arr['bar']['fit']['d']);
                if ($this->settings['thick'] >= 1) {
                    imageline($this->img, $x - $plus - 2, $open - 1, $x, $open - 1, $color_arr['bar']['fit']['d']);
                    imageline($this->img, $x, $close - 1, $x + 2, $close - 1, $color_arr['bar']['fit']['d']);
                }
            }
        }
    }

    function draw_lines($price, $x, $color)
    {
        $y_price = $this->getY($price);
        if ($y_price < $this->settings['h'] - $this->bottom_padding && $y_price > 5) {
            imageline($this->img, $x - $kontur + 1, $y_price, $w - 40, $y_price, $color);
            //imagestring($img,1,$x-$kontur+1,$y_price-10,$price,$red );

        }
    }


    public function addChart(){
        //fon
        imagefilledrectangle(
            $this->img,
            1,
            1,
            $this->settings['w'] - $this->right_padding,
            $this->settings['h'] - $this->bottom_padding,
            $this->settings['bgcolor']
        );



    }
    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return ChartDataFeeder
     */
    public function getFeed()
    {
        return $this->feed;
    }



    public function output() {
        header("Content-Type: image/png");
        imagepng($this->img);
    }



}