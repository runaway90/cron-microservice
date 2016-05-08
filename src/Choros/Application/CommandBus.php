<?php

namespace Choros\Application;

interface CommandBus
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
}
