<?php

namespace Cron\Application\Command;

use Cron\Domain\Job\Url;
use Cron\Domain\Jobs;

class DeactivateJobHandler
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

    public function handle(DeactivateJobCommand $command)
    {
        $job = $this->jobs->getByUrl(new Url($command->url));
        $job->deactivate();
    }
}
