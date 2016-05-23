<?php

namespace TestApp\Domain\Anime\Description;

use TestApp\Domain\Exception\InvalidTypeException;
use TestApp\Domain\Name;

final class Status
{
    const VALID_STATUSES = ['Emitted', 'Waiting', 'Finished'];

    private $name;

    public function __construct(string $name)
    {
        if (!$this->validate($name)) {
            throw new InvalidTypeException(sprintf("Invalid anime status. Valid statuses: %s", join(", ", self::VALID_STATUSES)));
        }

        $this->name = $name;
    }

    private function validate($name)
    {
        $stringName = (string)$name;

        return in_array($stringName, self::VALID_STATUSES, true);
    }

    public function __toString()
    {
        return (string)$this->name;
    }
}
