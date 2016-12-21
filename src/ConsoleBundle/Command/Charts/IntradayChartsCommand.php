<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command\Charts;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use DataFeedApp\ChartsDownloader\Sources\FileFeed;
use DataFeedApp\ChartsDownloader\Sources\Google;
use DataFeedApp\ChartsDownloader\Sources\IqFeed;
use DataFeedApp\ChartsDownloader\Sources\Yahoo;
use DataFeedApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class IntradayChartsCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:charts:intraday')
            ->setDescription("Downloading intraday history datafeed");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        date_default_timezone_set('America/New_York');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $result = $em->createQueryBuilder()
            ->select('c.ticker')
            ->from('ConsoleBundle:Charts\IntradayCounter', 'c')
            ->where('c.done = false')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();


        $progress = new ProgressBar($output, count($result));
        $progress->setFormat("%message%\n  %current%/%max% [%bar%] %percent:3s%% - %elapsed:6s%  ");
        $progress->setMessage("<comment>Downloading...</comment>");
        $progress->start();


        foreach ($result as $row) {

            $ticker = $row['ticker'];

            $progress->setMessage("<comment>Downloading ($ticker)...</comment>");

            if ($bars = $this->downloadBars($ticker)) {

                if (fwrite(@fopen(__DIR__ . "/../../../DataFeedApp/Filefeed/5/" . $ticker . ".txt", "w"),
                    json_encode($bars))) {

                    $this->dbQuery("UPDATE `feed_charts_intraday_counter` SET `writen` = TRUE WHERE `ticker` = '" . $ticker . "' LIMIT 1;");
                    $progress->advance();
                }
            }

            $this->dbQuery("UPDATE `feed_charts_intraday_counter` SET `done` = TRUE WHERE `ticker` = '" . $ticker . "' LIMIT 1;");
        }

        $progress->finish();

    }

    /** return bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    protected function downloadBars($ticker)
    {
        $downloader = new Google();
        $downloader->setTicker($ticker)
            ->setTf('5')
            ->setStartTime(time() - 60 * 60 * 15 * 24)
        //    ->setPremarket(true)
            ->setFinishTime(time());


        return $downloader->getBars();
    }

}