<?php

namespace Cron\Application\Command;

use Choros\Application\CommandBus;
use Cron\Domain\Job;
use Cron\Domain\Job\{CronExpression, Url};
use Cron\Domain\Jobs;

class CreateNewJobHandler
{
    /** @var Jobs */
    private $jobs;

    /** @var CommandBus */
    private $commandBus;

    /**
     * CreateNewJobHandler constructor.
     * @param Jobs $jobs
     */
    public function __construct(Jobs $jobs, CommandBus $commandBus)
    {
        $this->jobs = $jobs;
        $this->commandBus = $commandBus;
    }

    public function handle(CreateNewJobCommand $command)
    {
        $job = new Job(new CronExpression($command->expression), new Url($command->url));

        $this->jobs->add($job);

        $activateCommand = new ActivateJobCommand();
        $activateCommand->url = $command->url;

        $this->commandBus->handle($activateCommand);
    }
}
