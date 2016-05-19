<?php

namespace TestApp\UserInterface\Symfony\Command;

use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabaseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('anime:create-database')
            ->setDescription('Create database for anime')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine.dbal.default_connection');

        $schema = new Schema();
        $animeTable = $schema->createTable("anime");
        $animeTable->addColumn("name", "string", ["length" => 255]);
        $animeTable->addColumn("type", "string", ["length" => 30]);
        $animeTable->addColumn("status", "string", ["length" => 30]);
        $animeTable->addColumn("description_content", "text");
        $animeTable->addColumn("slug", "string", ["length" => 255]);

        $sqlArray = $schema->toSql(new MySqlPlatform());
        foreach ($sqlArray as $sql) {
            $doctrine->executeQuery($sql);
        }
    }
}
