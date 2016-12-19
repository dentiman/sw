<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.12.16
 * Time: 15:37
 */

namespace ConsoleBundle\Command;

use ConsoleBundle\Components\CustomContainerAwareCommand;
use ConsoleBundle\Utils\EarningParsers\ChameleonParser;
use ConsoleBundle\Utils\EarningParsers\ZackParser;
use ChartsApp\RemoteServerConnector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UpdateEarningsCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:earnings:update')
            ->setDescription('Update next week earnings for tickers')
            ->addArgument('days', InputArgument::REQUIRED, 'Amount of days to download')
            ->addArgument('ago', InputArgument::OPTIONAL, 'set argument to "ago" for inverse count ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $parser = new ZackParser();
     //   $parser = new ChameleonParser();

        $days =$input->getArgument('days');

        if($input->getArgument('ago') =='ago') {
            $days = $days*-1;
        }


        $this->loadData($output, [
            'data' => $parser->parse($days),
            'table' => 'feed_main_earnings',
            'head' => true
        ]);

    }
}