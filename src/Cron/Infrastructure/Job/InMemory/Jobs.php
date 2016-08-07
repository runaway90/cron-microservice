<?php

namespace Cron\Infrastructure\Job\InMemory;

use Cron\Domain\Job;
use Cron\Domain\Job\Url;
use Cron\Domain\Jobs as JobsInterface;

class Jobs implements JobsInterface
{
    private $jobs = [];
    
    public function add(Job $job)
    {
        $this->jobs[$job->getUrl()] = $job;
    }

    public function getByUrl(Url $url): Job
    {
        return $this->jobs[(string)$url];
    }

    public function exists(Url $url): bool
    {
        return isset($this->jobs[(string)$url]);
    }

    public function remove(Job $job)
    {
        unset($this->jobs[$job->getUrl()]);
    }
}
