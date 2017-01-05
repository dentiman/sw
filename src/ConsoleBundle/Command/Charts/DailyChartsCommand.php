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

class DailyChartsCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:charts:daily')
            ->setDescription("Downloading Daily history datafeed");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getManager();

        $result = $em->createQueryBuilder()
            ->select('c.ticker')
            ->from('ConsoleBundle:Charts\DailyCounter', 'c')
            ->where('c.done = false')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();

        $allticker = '';


        $progress = new ProgressBar($output, count($result));
        $progress->setFormat("%message%\n  %current%/%max% [%bar%] %percent:3s%% - %elapsed:6s%  ");
        $progress->setMessage("<comment>Downloading...</comment>");
        $progress->start();


        foreach ($result as $row) {

            $ticker = $row['ticker'];

            $progress->setMessage("<comment>Downloading ($ticker)...</comment>");

            if ($bars = $this->downloadBars($ticker)) {

                if (fwrite(@fopen(__DIR__ . "/../../../DataFeedApp/Filefeed/d/" . $ticker . ".txt", "w"),
                    json_encode($bars))) {

                    $this->dbQuery("UPDATE `feed_charts_daily_counter` SET `writen` = TRUE WHERE `ticker` = '" . $ticker . "' LIMIT 1;");
                    $progress->advance();
                }

                // build csv for import to daily charts history
                $allticker .= $this->feedArrayToCSV($bars, $ticker);

            }

            $this->dbQuery("UPDATE `feed_charts_daily_counter` SET `done` = TRUE WHERE `ticker` = '" . $ticker . "' LIMIT 1;");
        }

        $progress->finish();

        $this->loadData($output, [
            'data' => $allticker,
            'table' => 'feed_charts_daily_history',
        ]);

    }

    /** return bars feed array ['t','o','h','l','c','v']
     * @return array|bool
     */
    protected function downloadBars($ticker)
    {
        $downloader = new IqFeed();
        $downloader->setTicker($ticker)
            ->setTf('d')
            ->setStartTime(time() - 60 * 60 * 365 * 24)
            ->setFinishTime(time());

        return $downloader->getBars();
    }

    /**
     * @param array $feed
     * @param string $ticker
     * @return string
     */
    protected function feedArrayToCSV($feed, $ticker)
    {
        $csv = '';
        if (isset($feed['t']) && count($feed['t'])>=5) {

            for ($i = 0; $i <= 5; $i++) {
                $n = $i + 1;
                $csv .= $ticker . $n . ',' .
                    date('Y-m-d', $feed['t'][$i]) . ',' .
                    $feed['o'][$i] . ',' .
                    $feed['h'][$i] . ',' .
                    $feed['l'][$i] . ',' .
                    $feed['c'][$i] . ',' .
                    $feed['v'][$i] . ',' .
                    $n . ',' .
                    $ticker . "\r\n";

            }
        }
        return $csv;
    }


}