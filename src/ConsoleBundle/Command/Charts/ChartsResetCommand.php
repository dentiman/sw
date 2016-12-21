<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command\Charts;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use DataFeedApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class ChartsResetCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:charts:reset')
            ->setDescription("Reset Daily and 5min history datafeed");
          //  ->addArgument('mode', InputArgument::REQUIRED, 'What to update? ');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dbQuery('TRUNCATE `feed_charts_daily_counter`');
        $this->dbQuery('TRUNCATE `feed_charts_intraday_counter`');
        $this->dbQuery('TRUNCATE `feed_charts_daily_history`');
        $this->dbQuery("REPLACE INTO  `feed_charts_daily_counter` SELECT ticker,e,FALSE,FALSE,now(),NULL FROM `feed_main_basic_data`");
        $this->dbQuery("REPLACE INTO  `feed_charts_intraday_counter` SELECT ticker,e,FALSE,FALSE,now(),NULL FROM `feed_main_basic_data`");

    }




}