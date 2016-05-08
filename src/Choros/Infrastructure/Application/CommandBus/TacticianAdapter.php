<?php

namespace Choros\Infrastructure\Application\CommandBus;

use Choros\Application\CommandBus as BaseCommandBus;
use League\Tactician\CommandBus;

final class TacticianAdapter implements BaseCommandBus
{
    /** @var CommandBus */
    private $commandBus;

    public function handle($command)
    {
        $this->commandBus->handle($command);
    }

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }
}
