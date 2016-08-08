<?php

namespace Cron\UserInterface\Symfony\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:test');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        do {
            echo getenv('DATABASE_HOST'). ' ';
            echo $this->getContainer()->getParameter('database_host')."\n";
            sleep(1);
        } while(true);
    }
}
