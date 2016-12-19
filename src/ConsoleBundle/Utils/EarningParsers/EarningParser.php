<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 13.12.16
 * Time: 12:58
 */

namespace ConsoleBundle\Utils\EarningParsers;


interface EarningParser
{
    /** CSV string for import to db
     * @param integer $days
     * @return string
     */
    public function parse($days);
}