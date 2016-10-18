<?php

namespace Tester\Cron;

use Cron\Domain\Job\CronExpression;
use Cron\Domain\Job\Url;
use Cron\Domain\Job;
use Cron\Infrastructure\Job\InMemory\Jobs;
use PHPUnit\Framework\TestCase;

class StaticJobCaseTest extends TestCase
{
    function testCaseStaticUrl()
    {
        $job = new Job(new CronExpression('* * * * *'), new Url('http://example.org/path'));
        $data=$job->getUrl();
        
        $this->assertContains($data, 'http://example.org/path');
        $this->assertContainsOnly('bool',[$job->shouldBeDone()]);
        $this->assertContainsOnly('string',[$job->getUrl()]);
        $this->assertContainsOnly('null',[$job->activate()]);
        $this->assertCount(1,[$job->activate()]);
        $this->assertNotEmpty($job->getUrl());
        $this->assertGreaterThan(0,count($data));
        //$this->assertInstanceOf(new Url('http://example.org/path'), new Job(new CronExpression('* * * * *'), new Url('http://example.org/path')));
        //$this->assertClassHasAttribute('* * * * *',Job::class)  ;
    }
}
