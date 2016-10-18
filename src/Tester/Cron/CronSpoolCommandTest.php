<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 10/14/16
 * Time: 2:48 PM
 */

namespace Tester\Cron;


use Cron\UserInterface\Symfony\Command\CronSpoolCommand;

class CronSpoolCommandTest extends \PHPUnit_Framework_TestCase
{
    function testSpoolCommand()
    {
        $spool = new CronSpoolCommand();
        $this->assertEquals('cron:spool',$spool->getName());
        $this->assertEquals([],$spool->getAliases());
        $this->assertTrue($spool->isEnabled());
        $this->assertEquals('',$spool->getDescription());
    }
}
