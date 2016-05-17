<?php

namespace TestApp\Domain;

use TestApp\Domain\Anime\Description;

class Anime
{
    /** @var Name */
    private $name;

    /** @var Description */
    private $description;

    public function __construct(Name $name)
    {
        $this->name = $name;
        $this->description = new Description();
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function updateDescription(Description $description)
    {
        $this->description = $description;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }
}
