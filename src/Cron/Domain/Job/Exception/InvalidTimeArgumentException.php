<?php

namespace Cron\Domain\Job\Exception;

class InvalidTimeArgumentException extends Exception
{
    public static function fromString(string $expression): InvalidTimeArgumentException
    {
        return new InvalidTimeArgumentException(sprintf("Invalid cron expression '%s'.", $expression));
    }
}
