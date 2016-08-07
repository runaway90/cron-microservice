<?php

namespace Cron\Domain\Exception;

use Cron\Domain\Job\Url;

class JobNotFoundException extends Exception
{
    public static function byUrl(Url $url): JobNotFoundException
    {
        return new JobNotFoundException(sprintf("Job with URL '%s' not found.", $url));
    }
}
