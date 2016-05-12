<?php

namespace TestApp\Domain\Anime\Description;

use TestApp\Domain\Exception\InvalidArgumentException;

class Content
{
    private $content;

    public function __construct(string $content)
    {
        if (empty($content)) {
            throw new InvalidArgumentException("Anime description content needs to be not empty string.");
        }

        $this->content = $content;
    }

    function __toString()
    {
        return $this->content;
    }
}
