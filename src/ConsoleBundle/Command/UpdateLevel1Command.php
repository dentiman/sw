<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use ChartsApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class UpdateLevel1Command extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:level1:update')
            ->setDescription('Update level1 table from IQfeed,Goole Finance, Finviz')
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
            case 'finviz':
                $this->updateFinviz($output);
                break;
            case 'google':
                $this->updateGoogle($output);
                break;
            case 'basic':

                $this->updateIqfeed($output);
                $this->updateFinviz($output);
                $this->updateGoogle($output);

                $this->dbQuery("REPLACE INTO `feed_level1_sources`  SELECT * FROM `feed_level1_google` LEFT JOIN  (SELECT `ticker`,NULL AS bid,NULL AS ask,NULL AS bidsize,NULL AS asksize,NULL AS tcount,`vol`,'gf' AS source FROM `feed_level1_finviz` ) AS `T` USING(ticker)");
                break;

            case 'delay':
                $this->updateYahoo($output);
                break;

            // UPDATE Level1 table after market close
            case 'close':
                $this->updateYahoo($output);
                $this->dbQuery("TRUNCATE feed_main_level1");
                $this->dbQuery("REPLACE INTO `feed_main_level1`  SELECT * FROM `feed_level1_yahoo` ");
                break;
            default:
                $output->writeln('<error>Available arguments: yahoo,iqfeed,finviz,google,basic,delay,close</error>');
                break;
        }


        //SELECT count(ticker),source FROM sw.feed_level1_sources GROUP BY sw.feed_level1_sources.source
    }


    protected function updateFinviz(OutputInterface $output)
    {
        $output->writeln('<comment>Finviz downloading ... </comment>');
        $connector = new RemoteServerConnector();
        $str = $connector->getContent('/connector/finviz.php?v=152&c=1,65,66,67');
        $str = str_replace("%", "", $str);

        $this->dbQuery("TRUNCATE feed_level1_finviz");

        $this->loadData($output, [
            'data' => $str,
            'table' => 'feed_level1_finviz',
            'head' => true
        ]);
    }

    /** Update SOURCES table: ticker,price,op,hi,lo,chp,ch,ttime,bid,ask,bidsize,asksize,tccount,vol,source
     * @param OutputInterface $output
     */
    protected function updateIqfeed(OutputInterface $output)
    {
        $output->writeln('<comment>Iqfeed downloading ...  </comment>');
        $connector = new RemoteServerConnector();
        $csv = $connector->getLevel1();

        $this->dbQuery("TRUNCATE feed_level1_sources");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_level1_sources',
            'head' => true
        ]);

        $this->dbQuery("UPDATE `feed_level1_sources` SET `chp` = ROUND(chp*100,2), `bidsize` = bidsize/100, `asksize` = asksize/100");
    }


    /** Update GOOGLE table: ticker,price,op,hi,lo,chp,ch,ttime
     * @param OutputInterface $output
     */
    protected function updateGoogle(OutputInterface $output)
    {

        $exchange = array(1 => "NYSE", 2 => "NASDAQ", 3 => "NYSEMKT", 4 => "NYSEARCA", 5 => "PINK", 6 => "BATS");

        $A = [];
        $em = $this->getContainer()->get('doctrine')->getManager();
        $result = $em->createQueryBuilder()->select('b.ticker, b.e ')
            ->from('AppBundle:Feed\MainBasicData', 'b')
            ->leftJoin('ConsoleBundle:Level1\Sources', 'l', 'WITH', 'b.ticker=l.ticker')
            ->where('l.price IS NULL')
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

                if (isset($data->t)) {

                    $csv .= str_replace('.', '-', $data->t) . ',' .
                        str_replace(',', '', $data->l) . ',' .
                        str_replace(',', '', $data->op) . ',' .
                        str_replace(',', '', $data->hi) . ',' .
                        str_replace(',', '', $data->lo) . ',' .
                        str_replace(',', '', $data->cp) . ',' .
                        str_replace(',', '', $data->c) . ',' .
                        date('H:i:s', strtotime($data->ltt)) . ',,,,,' . "\r\n";
                }
            }

            $progress->advance();
        }

        $progress->finish();

        $this->dbQuery("TRUNCATE feed_level1_google");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_level1_google',
            'head' => true
        ]);

    }


    /** Update YAHOO table: ticker,price,op,hi,lo,chp,ch,ttime,bid,ask,bidsize,asksize,tccount,vol
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
                    $groups) . '&f=sl1ohgp2c1t1bab6a5iv&e=.csv');

            $progress->advance();

        }
        $progress->finish();
        $csv = str_replace(",N/A", ",NULL", $csv);
        $csv = str_replace("%", "", $csv);

        $pattern = "/(\d+):(\d+)(pm|am)/i";
        $replacement = "\${1}:\$2:00 \$3";
        $csv = preg_replace($pattern, $replacement, $csv);


        $this->dbQuery("TRUNCATE feed_level1_yahoo");

        $this->loadData($output, [
            'data' => $csv,
            'table' => 'feed_level1_yahoo',
            'lines_terminated' => "\n",
            'head' => false
        ]);

        $this->dbQuery("SET sql_mode = ''");

        $this->dbQuery("UPDATE `feed_level1_yahoo` SET  `bidsize` = bidsize/100, `asksize` = asksize/100, ttime = STR_TO_DATE(ttime, '%h:%i:%s %p')");

    }


}