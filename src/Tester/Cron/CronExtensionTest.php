<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 10/14/16
 * Time: 2:49 PM
 */

namespace Tester\Cron;

use Cron\UserInterface\Symfony\DependencyInjection\CronExtension;
use \PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CronExtensionTest extends TestCase
{
    function testCronExtension()
    {
        $cron = new CronExtension();
        $this->assertEquals(null,$cron->load([], new ContainerBuilder()));
    }
}
