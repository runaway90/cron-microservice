<?php

namespace Tester\Cron;

use Cron\Domain\Job\CronExpression;
use Cron\Domain\Job\Url;
use Cron\Domain\Job;
use Cron\Infrastructure\Job\InMemory\Jobs;

class StaticJobTest extends \PHPUnit_Framework_TestCase
{
    function testStaticUrl()
    {
        $job = new Job(new CronExpression('* * * * *'), new Url('http://example.org/path'));
        $job->activate();
        
        $this->assertEquals($job->getUrl(), new Url('http://example.org/path'));
        $this->assertEquals(true,$job->isActive());
        $this->assertEquals(false,$job->deactivate());
        $this->assertTrue($job);
        $this->assertStringStartsWith('http://example.org',$job->getUrl());

        //$this->assertEquals();
        //$this->assertObjectHasAttribute($job->shouldBeDone(), new CronExpression('* * * * *'));
        //$this->assertTrue($job->activate());
        //$this->assertEquals(true,$job->activate());

    }
}
