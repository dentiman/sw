<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 10.12.16
 * Time: 13:29
 */

namespace ConsoleBundle\Components;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class CustomContainerAwareCommand extends ContainerAwareCommand
{

    private $dbConnection = false;


    protected function getConnection()
    {

        if ($this->dbConnection == false) {
            $em = $this->getContainer()->get('doctrine')->getManager();
            $this->dbConnection = $em->getConnection();
        }

        return $this->dbConnection;

    }


    protected function dbQuery($query){
        $this->getConnection()->prepare($query)->execute();
    }

    /**
     * Import CSV data to using LOAD DATA INFILE (sql)
     * @param OutputInterface $output An OutputInterface instance
     * @param array
     */
    protected function loadData(OutputInterface $output,array $options)
    {

        $options_default = [
            'data' => null,
            'table' => null,
            'fields_terminated' => ',',
            'lines_terminated' => "\r\n",
            'enclosed' => '\"',
            'head' => false
        ];

        $options = array_merge($options_default, $options);

        $filedir = "/var/lib/mysql/sw/";
        $filename = "loadData.csv";
        $file = fopen($filedir . $filename, "w");
        fwrite($file, $options['data']);
        fclose($file);

        if (file_exists($filedir . $filename)) {

            $sql = "LOAD DATA INFILE '$filename' REPLACE INTO TABLE " . $options['table'] .
                "  FIELDS TERMINATED BY '" . $options['fields_terminated'] .
                "' ENCLOSED BY '" . $options['enclosed'] .
                "' LINES TERMINATED BY '" . $options['lines_terminated'] . "'";

            if ($options['head']) {
                $sql .= ' IGNORE 1 LINES';
            }

            if($this->getConnection()->prepare($sql)->execute()) {
                $output->writeln('<info>imported success!</info>');
            } else {
                $this->writeError($output,'import error');
            }

            unlink($filedir . $filename);

        } else {
            $this->writeError($output,'file no exists!!');
        }
    }


    /**
     * @param OutputInterface $output
     * @param string          $message
     */
    private function writeError(OutputInterface $output, $message)
    {
        $output->writeln(sprintf("\n<error>%s</error>", $message));
    }
}