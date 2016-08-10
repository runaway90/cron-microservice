<?php

namespace Cron\UserInterface\Symfony\Command;

use Cron\Domain\Jobs;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronSpoolCommand extends ContainerAwareCommand
{
    /** @var Jobs */
    private $jobs;

    protected function configure()
    {
        $this
            ->setName('cron:spool');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$this->jobs->
    }
}
