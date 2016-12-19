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

class ChartsDownloadCommand extends CustomContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feed:charts:update')
            ->setDescription("Downloading Daily or 5min history datafeed");
          //  ->addArgument('mode', InputArgument::REQUIRED, 'What to update? ');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $result = $em->createQueryBuilder()
            ->select('c')
            ->from('ConsoleBundle:Charts\DailyCounter','c')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();

        foreach ($result as $row) {
            $output->writeln($row->getTicker());

        }

    }




}