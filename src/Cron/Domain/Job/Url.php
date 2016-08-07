<?php

namespace Cron\Domain\Job;

use Cron\Domain\Job\Exception\InvalidUrlArgumentException;

class Url
{
    /** @var string */
    private $url;

    /**
     * Url constructor.
     * @param string $url
     * @throws InvalidUrlArgumentException
     */
    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL) || substr($url, 0, 4) !== "http") {
            throw InvalidUrlArgumentException::fromString($url);
        }

        $this->url = $url;
    }

    function __toString()
    {
        return $this->url;
    }
}
