<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 10/14/16
 * Time: 2:47 PM
 */

namespace Tester\Cron;


use Cron\Domain\Job;
use Cron\Infrastructure\Job\InMemory\Jobs;
use PHPUnit\Framework\TestCase;

class JobsInMemoryTest extends TestCase
{
    function testJobsInMemory()
    {
        $this->assertEmpty(Jobs::class);
        
        $test = new Jobs(new Job\Url('http://example.org/memory'));
        
        $this->assertEquals(true,$test->exists('http://example.org/memory'));
        $this->assertClassHasAttribute(Jobs::class, $test);
    }
}
