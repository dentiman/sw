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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class UpdatePremarketCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:premarket:update')
            ->setDescription('Update premarket table from IQfeed,Goole Finance, Finviz')
            ->addArgument('mode', InputArgument::REQUIRED, 'What to update? ');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('mode')) {
            case 'yahoo':
                $this->updateYahoo($output);
                break;
            case 'iqfeed':
                $this->updateIqfeed($output);
                break;
            case 'google':
                $this->updateGoogle($output);
                break;
            case 'basic':

                $this->updateIqfeed($output);
                $this->updateGoogle($output);

                $this->dbQuery("REPLACE INTO `feed_main_premarket`  SELECT * FROM `feed_premarket_iqfeed` LEFT JOIN   `feed_premarket_google` USING(ticker)");
                break;


            default:
                $output->writeln('<error>Available arguments: yahoo,iqfeed,finviz,google,basic,delay,close</error>');
                break;
        }
    }


    /** Update Iqfeed table: ticker,pvol,ptcount
     * @param OutputInterface $output
     */
    protected function updateIqfeed(OutputInterface $output)
    {
        $output->writeln('<comment>Iqfeed downloading ...  </comment>');
        $connector = new RemoteServerConnector();
        $csv = $connector->getPremarket();

        $this->dbQuery("TRUNCATE feed_premarket_iqfeed");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_premarket_iqfeed',
            'head' => true
        ]);

      //  $this->dbQuery("UPDATE `feed_level1_sources` SET `chp` = ROUND(chp*100,2), `bidsize` = bidsize/100, `asksize` = asksize/100");
    }


    /** Update GOOGLE table: ticker,pprice,pchp,pch
     * @param OutputInterface $output
     */
    protected function updateGoogle(OutputInterface $output)
    {

        $exchange = array(1 => "NYSE", 2 => "NASDAQ", 3 => "NYSEMKT", 4 => "NYSEARCA", 5 => "PINK", 6 => "BATS");

        $A = [];
        $em = $this->getContainer()->get('doctrine')->getManager();
        $result = $em->createQueryBuilder()->select('b.ticker, b.e,l.pvol ')
            ->from('AppBundle:Feed\MainBasicData', 'b')
            ->leftJoin('ConsoleBundle:Premarket\Iqfeed', 'l', 'WITH', 'b.ticker=l.ticker')
            ->where('l.pvol > 0')
            ->getQuery()
            ->getResult();

        foreach ($result as $row) {
            $A[] = $row['ticker'] . ':' . $exchange[$row['e']];
        }

        $tickers_all = count($A);


        $A = array_chunk($A, 100);
        $csv = '';

        $progress = new ProgressBar($output,count($A));
        $progress->setFormat("%message%\n  %current%/%max% [%bar%] %percent:3s%% - %elapsed:6s%  ");
        $progress->start();
        $progress->setMessage("<comment>Google downloading ($tickers_all tickers)...</comment>");

        foreach ($A as $groups) {

            $content = file_get_contents('http://www.google.com/finance/info?infotype=infoquoteall&q=' .
                implode(',', $groups));

            $bad = array("//", "\\x");
            $good = array("", "");
            $fileapi = str_replace($bad, $good, $content);
            $fileapi = json_decode($fileapi);


            foreach ($fileapi as $data) {

                if (isset($data->t) && isset($data->el)) {

                    $csv .= str_replace('.', '-', $data->t) . ',' .
                        str_replace(',', '', $data->el) . ',' .
                        str_replace(',', '', $data->ecp) . ',' .
                        str_replace(',', '', $data->ec) .  "\r\n";

                }
            }

            $progress->advance();
        }

        $progress->finish();

        $this->dbQuery("TRUNCATE feed_premarket_google");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_premarket_google',
            'head' => true
        ]);

    }


    /** Update YAHOO table: ticker,pprice,pchp,pch,pvol
     * @param OutputInterface $output
     */
    protected function updateYahoo(OutputInterface $output)
    {

        $A = [];
        $em = $this->getContainer()->get('doctrine')->getManager();
        $result = $em->createQueryBuilder()->select('b.ticker')
            ->from('AppBundle:Feed\MainBasicData', 'b')
            ->getQuery()
            ->getResult();

        foreach ($result as $row) {
            $A[] = $row['ticker'];
        }

        $A = array_chunk($A, 150);
        $csv = '';

        $progress = new ProgressBar($output,count($A));
        $progress->setFormat("%message%\n  %current%/%max% [%bar%] %percent:3s%% - %elapsed:6s%  ");
        $progress->start();
        $progress->setMessage("<comment>Yahoo downloading...</comment>");

        foreach ($A as $groups) {

            $csv .= @file_get_contents('http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',',
                    $groups) . '&f=sl1k2c6v&e=.csv');

            $progress->advance();

        }
        $progress->finish();
        $csv = str_replace(",N/A", ",NULL", $csv);
        $csv = str_replace("%", "", $csv);


        $this->dbQuery("TRUNCATE feed_premarket_yahoo");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_premarket_yahoo',
            'lines_terminated' => "\n",
            'head' => false
        ]);

    }



}