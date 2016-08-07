<?php

namespace Cron\Application\Command;

use Cron\Domain\Job\Url;
use Cron\Domain\Jobs;

class UninstallJobHandler
{
    /** @var Jobs */
    private $jobs;

    /**
     * CreateNewJobHandler constructor.
     * @param Jobs $jobs
     */
    public function __construct(Jobs $jobs)
    {
        $this->jobs = $jobs;
    }

    public function handle(UninstallJobCommand $command)
    {
        $job = $this->jobs->getByUrl(new Url($command->url));
        $this->jobs->remove($job);
    }
}
