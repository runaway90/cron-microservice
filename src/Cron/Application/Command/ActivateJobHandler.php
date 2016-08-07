<?php

namespace Cron\Application\Command;

use Cron\Domain\Job\Url;
use Cron\Domain\Jobs;

class ActivateJobHandler
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
    
    public function handle(ActivateJobCommand $command)
    {
        $job = $this->jobs->getByUrl(new Url($command->url));
        $job->activate();
    }
}
