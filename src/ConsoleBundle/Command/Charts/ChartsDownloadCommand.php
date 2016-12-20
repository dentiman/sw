<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command\Charts;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use DataFeedApp\ChartsDownloader\Sources\IqFeed;
use DataFeedApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class ChartsDownloadCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:charts:update')
            ->setDescription("Downloading Daily or 5min history datafeed")
           ->addArgument('timeframe', InputArgument::REQUIRED, 'timeframe: d or 5 ');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();

        $result = $em->createQueryBuilder()
            ->select('c')
            ->from('ConsoleBundle:Charts\DailyCounter','c')
            ->where('c.done = false')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        $allticker ='';
        $tf = $input->getArgument('timeframe');

        foreach ($result as $row) {

            $ticker = $row->getTicker();

            if($bars = $this->downloadBars($ticker,$tf)) {

                if(fwrite(@fopen( __DIR__."/../../../DataFeedApp/Filefeed/".$tf."/".$ticker.".txt", "w"),json_encode($bars))) {
                    $output->writeln($ticker.' > OK');

                    $this->dbQuery("UPDATE `feed_charts_daily_counter` SET `writen` = true WHERE `ticker` = '".$ticker."' LIMIT 1;");
                }

                if($tf =='d') {
                    //build csv for import to daily charts history
                    $csv = $this->feedArrayToCSV($bars);
                    $csv_row = explode("\r\n", $csv, 6);
                    $allticker .=
                        $ticker . '1,' . $csv_row[0] . ',1,' . $ticker . "\r\n" .
                        $ticker . '2,' .$csv_row[1] . ',2,' . $ticker . "\r\n" .
                        $ticker . '3,' .$csv_row[2] . ',3,' . $ticker . "\r\n" .
                        $ticker . '4,' . $csv_row[3] . ',4,' . $ticker . "\r\n" .
                        $ticker . '5,' . $csv_row[4] . ',5,' . $ticker . "\r\n";
                }
            }

            $this->dbQuery("UPDATE `feed_charts_daily_counter` SET `done` = true WHERE `ticker` = '".$ticker."' LIMIT 1;");
        }

        if($tf =='d') {
            $this->loadData($output, [
                'data' => $allticker,
                'table' => 'feed_charts_daily_history',
            ]);
        }
    }


    protected function downloadBars($ticker,$tf) {

        $downloader = new IqFeed();
        $downloader->setTicker($ticker)
            ->setTf($tf)
            ->setStartTime( time() - 60 * 60 * 100 * 24)
            ->setFinishTime(time());

        return $downloader->getBars();

    }

    protected function feedArrayToCSV($feed){
        $csv =''; $n=0;
        if(isset($feed['t'])) {
            foreach ($feed['t'] as  $value) {
                $csv .= date('Y-m-d',$value).','.
                    $feed['o'][$n].','.
                    $feed['h'][$n].','.
                    $feed['l'][$n].','.
                    $feed['c'][$n].','.
                    $feed['v'][$n]."\r\n";
                $n++;
            }
        }
        return $csv;
    }


}