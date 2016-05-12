<?php

namespace TestApp\Domain;

use TestApp\Domain\Exception\EmptyNameException;

final class Name
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new EmptyNameException("Name can't be created from empty value.");
        }

        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function isEqual(Name $name)
    {
        return strtolower($this->name) === strtolower($name->name);
    }
}
