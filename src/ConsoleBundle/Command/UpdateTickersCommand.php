<?php
namespace ConsoleBundle\Command;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdateTickersCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('feed:tickers:update')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates new users.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to create users...")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Import NASDAQ Tickers
        $str =  @file_get_contents('ftp://ftp.nasdaqtrader.com/symboldirectory/nasdaqlisted.txt');

        if ($str = explode('File Creation Time',$str)) {

            $this->loadData($output,[
                'data' => $str[0],
                'table'=>'feed_tickers_nasdaq_listed',
                'fields_terminated' => '|',
                'head' =>true
            ]);
        }

        //Import other tickers
        $str =  file_get_contents('ftp://ftp.nasdaqtrader.com/symboldirectory/otherlisted.txt');
        if ($str = explode('File Creation Time',$str)) {

            $this->loadData($output,[
                'data' => $str[0],
                'table'=>'feed_tickers_other_listed',
                'fields_terminated' => '|',
                'head' =>true
            ]);
        }

        // remove some rows
        $this->dbQuery("DELETE  FROM `feed_tickers_other_listed` WHERE `test`=  'Y'");
        $this->dbQuery("DELETE  FROM `feed_tickers_nasdaq_listed` WHERE `test`=  'Y'");
        $this->dbQuery("DELETE  FROM `feed_tickers_nasdaq_listed` WHERE `ticker`=  'Symbol'");
        $this->dbQuery("DELETE  FROM `feed_tickers_other_listed` WHERE `exchange`=  ''");
        $this->dbQuery("DELETE  FROM `feed_tickers_other_listed` WHERE `ticker` =  'NASDAQ'");
        $this->dbQuery("DELETE  FROM `feed_tickers_nasdaq_listed` WHERE `test`=  ''");


        $this->dbQuery("UPDATE `feed_tickers_other_listed` SET `exchange` = '1' WHERE `feed_tickers_other_listed`.`exchange` = 'N';");
        $this->dbQuery("UPDATE `feed_tickers_other_listed` SET `exchange` = '3' WHERE `feed_tickers_other_listed`.`exchange` = 'A';");
        $this->dbQuery("UPDATE `feed_tickers_other_listed` SET `exchange` = '4' WHERE `feed_tickers_other_listed`.`exchange` = 'P';");
        $this->dbQuery("UPDATE `feed_tickers_other_listed` SET `exchange` = '6' WHERE `feed_tickers_other_listed`.`exchange` = 'Z';");
        $this->dbQuery("UPDATE `feed_tickers_nasdaq_listed` SET `name` = REPLACE( name, ' - Common Stock', '' ) ;");
        $this->dbQuery("UPDATE `feed_tickers_nasdaq_listed` SET `name` = REPLACE( name, ' - Common Shares', '' ) ;");

        $this->dbQuery("REPLACE INTO  `feed_basic_tickers` (SELECT ticker,2 as 'exchange',name,etf  FROM `feed_tickers_nasdaq_listed`) UNION ALL (SELECT ticker,exchange,name,etf FROM `feed_tickers_other_listed`) ORDER BY ticker;");

        $this->dbQuery("DELETE  FROM `feed_basic_tickers` WHERE `ticker` REGEXP '[^A-Za-z]'");

        $this->dbQuery("UPDATE `feed_basic_tickers` SET `etf` = '1' WHERE `etf`=  'Y'");
        $this->dbQuery("UPDATE `feed_basic_tickers` SET `etf` = '0' WHERE `etf`=  'N'");

       // $this->dbQuery("DELETE FROM `feed_basic_tickers` WHERE LENGTH(ticker) = 5");

    }

}