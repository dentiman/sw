<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 18:29
 */

namespace ChartsApp;


class RemoteServerConnector
{
    protected $server1 ='88.99.14.227';

    protected $server2 ='78.46.199.135';

    public  function getContent($url){

        return @file_get_contents('http://'.$this->server2.$url);
    }


    public function getLevel1(){

        $url = '/iqfeed/files/level1/';

        $csv = str_replace("\n", ",i0\r\n", @file_get_contents('http://' . $this->server1 . $url.'0.txt'));
        $csv .= str_replace("\n", ",i1\r\n", @file_get_contents('http://' . $this->server1 . $url.'1.txt'));
        $csv .= str_replace("\n", ",i2\r\n", @file_get_contents('http://' . $this->server1 . $url.'2.txt'));
        $csv .= str_replace("\n", ",i3\r\n", @file_get_contents('http://' . $this->server1 . $url.'3.txt'));

        $csv .= str_replace("\n", ",i4\r\n", @file_get_contents('http://' . $this->server2 .$url.'4.txt'));
        $csv .= str_replace("\n", ",i5\r\n", @file_get_contents('http://' . $this->server2 .$url. '5.txt'));
        $csv .= str_replace("\n", ",i6\r\n", @file_get_contents('http://' . $this->server2 . $url.'6.txt'));
        $csv .= str_replace("\n", ",i7\r\n", @file_get_contents('http://' . $this->server2 . $url.'7.txt'));

        return $csv;

    }


    public function getPremarket(){

        $url = '/iqfeed/files/level1prem/';

        $csv = str_replace("\n", ",i0\r\n", @file_get_contents('http://' . $this->server1 . $url.'0.txt'));
        $csv .= str_replace("\n", ",i1\r\n", @file_get_contents('http://' . $this->server1 . $url.'1.txt'));
        $csv .= str_replace("\n", ",i2\r\n", @file_get_contents('http://' . $this->server1 . $url.'2.txt'));
        $csv .= str_replace("\n", ",i3\r\n", @file_get_contents('http://' . $this->server1 . $url.'3.txt'));

        $csv .= str_replace("\n", ",i4\r\n", @file_get_contents('http://' . $this->server2 .$url.'4.txt'));
        $csv .= str_replace("\n", ",i5\r\n", @file_get_contents('http://' . $this->server2 .$url. '5.txt'));
        $csv .= str_replace("\n", ",i6\r\n", @file_get_contents('http://' . $this->server2 . $url.'6.txt'));
        $csv .= str_replace("\n", ",i7\r\n", @file_get_contents('http://' . $this->server2 . $url.'7.txt'));

        return $csv;

    }
}