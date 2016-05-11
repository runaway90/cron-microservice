<?php

namespace Choros\Infrastructure\Application\CommandBus;

use Choros\Application\CommandBus as BaseCommandBus;
use Prooph\ServiceBus\CommandBus;

final class ProophAdapter implements BaseCommandBus
{
    /** @var CommandBus */
    private $commandBus;

    public function handle($command)
    {
        $this->commandBus->dispatch($command);
    }

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}
