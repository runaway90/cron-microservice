<?php
namespace Tester\Cron;

use Cron\Application\Job\Criteria;

class CriteriaTest extends \PHPUnit_Framework_TestCase
{

 public function testCriteria()
 {
     $job = new Criteria();
     $job->limit(1000);
     $job->offset(10);

     $this->assertEquals(10, $job->getOffset());
     $this->assertEquals(1000, $job->getLimit());
     $this->assertEquals([],$job->getConditions());
 }
}
