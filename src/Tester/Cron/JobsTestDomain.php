<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 10/14/16
 * Time: 2:46 PM
 */

namespace Tester\Cron;


use Cron\Domain\Job;
use Cron\Domain\Job\CronExpression;
use Cron\Domain\Job\Url;
use Cron\Infrastructure\Job\Doctrine\ORM\Domain\Jobs;
use Doctrine\ORM\EntityManager;

class JobsDomainTest extends \PHPUnit_Framework_TestCase
{
    function testJobsDomain()
    {
        $url = null;
        $test=new Jobs(EntityManager::class);
        $test->add(new Job(new CronExpression('* * * * *'),
                           new Url('http://example.org/path')));
        
        //$this->assertEquals($test->getByUrl(), new Url('http://example.org/path'));
    }
}
