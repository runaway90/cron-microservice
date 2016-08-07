<?php

namespace Cron\Application\Command;

use Cron\Domain\Job;
use Cron\Domain\Job\{CronExpression, Url};
use Cron\Domain\Jobs;

class CreateNewJobHandler
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

    public function handle(CreateNewJobCommand $command)
    {
        $job = new Job(new CronExpression($command->expression), new Url($command->url));

        $this->jobs->add($job);
    }
}
