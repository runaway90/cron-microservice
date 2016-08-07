<?php

namespace Cron\Domain\Job\Exception;

class InvalidUrlArgumentException extends Exception
{
    public static function fromString(string $url): InvalidUrlArgumentException
    {
        return new InvalidUrlArgumentException(sprintf("Invalid url '%s'.", $url));
    }
}
