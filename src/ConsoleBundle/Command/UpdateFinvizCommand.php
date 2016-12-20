<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use DataFeedApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdateFinvizCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:finviz:update')
            ->setDescription('Update all finviz data ') ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $columns = '1,3,4,5,6,7,8,16,24,25,26,30,31,42,43,44,45,46,49,52,53,54,55,56,57,58,63';
        // import all stocks
        $this->getRemoteContent($output,'/connector/finviz.php?v=152&c='.$columns,0);
        // replace width index S&P 500
        $this->getRemoteContent($output,'/connector/finviz.php?v=152&f=idx_sp500&c='.$columns,1);
        // replace width index DJ 30
        $this->getRemoteContent($output,'/connector/finviz.php?v=152&f=idx_dji&c='.$columns,2);

    }


    protected function getRemoteContent(OutputInterface $output,$url,$index) {

        $connector = new RemoteServerConnector();

        $str = $connector->getContent($url);

        //add index column
        $str = str_replace("\r\n",",".$index."\r\n",$str);
        //remove percent from rows for success import
        $str = str_replace("%","",$str);



        $this->loadData($output,[
            'data' => $str ,
            'table'=>'feed_basic_finviz',
            'head' =>true
        ]);
    }
}