<?php

namespace Cron\UserInterface\Symfony\Command;

use Cron\Application\Domain\Jobs;
use Cron\Application\Job\Criteria;
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
        $this->jobs = $this->getContainer()->get('cron.storage.jobs');

        $criteria = new Criteria();

        $jobs = $this->jobs->getByCriteria($criteria);

        var_dump($jobs);
    }
}
