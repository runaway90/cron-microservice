<?php

namespace Cron\UserInterface\Symfony\Command;

use Cron\Application\Domain\Jobs;
use Cron\Application\Job\Criteria;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CronSpoolCommand extends ContainerAwareCommand
{
    /** @var Jobs */
    private $jobs;

    /** @var Logger */
    private $logger;

    protected function configure()
    {
        $this
            ->setName('cron:spool');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->jobs = $this->getContainer()->get('cron.storage.jobs');
        $this->logger = $this->getContainer()->get('logger');

        $criteria = new Criteria();
        $criteria->onlyActive();

        $jobs = $this->jobs->getByCriteria($criteria);

        $processes = [];
        foreach ($jobs as $job) {
            if ($job->shouldBeDone()) {
                $process = $this->runNotifierProcess($job->getUrl());
                $processes[] = $process;
            }
        }

        $doWork = true;
        while ($doWork) {
            $doWork = false;
            /** @var Process $process */
            foreach ($processes as $process) {
                if ($process->isRunning()) {
                    $doWork = true;
                }
            }

            usleep(300000);
        }

        foreach ($processes as $process) {
            if ($process->isSuccessful()) {
                $this->logger->debug("Finished: ".$process->getCommandLine()." with output: ". $process->getOutput());
            } else {
                $this->logger->error("Failed to run ".$process->getCommandLine()." with output: ". $process->getErrorOutput());
            }
        }
    }

    /**
     * @param $url
     * @return Process
     */
    private function runNotifierProcess($url)
    {
        $this->logger->debug('Notifying URL: '.$url);
        $process = new Process("curl ".$url);
        $process->start();
        $process->setTimeout(5);

        return $process;
    }
}
