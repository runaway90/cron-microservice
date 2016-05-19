<?php

namespace TestApp\Domain\Anime\Description;

use TestApp\Domain\Exception\InvalidTypeException;
use TestApp\Domain\Name;

final class Type
{
    const VALID_TYPES = ['OVA', 'TV', 'Film'];

    private $name;

    public function __construct(Name $name)
    {
        if (!$this->validate($name)) {
            throw new InvalidTypeException(sprintf("Invalid anime type. Valid types: %s", join(", ", self::VALID_TYPES)));
        }

        $this->name = $name;
    }

    private function validate(Name $name)
    {
        $stringName = (string)$name;

        return in_array($stringName, self::VALID_TYPES, true);
    }

    public function __toString()
    {
        return (string)$this->name;
    }
}
