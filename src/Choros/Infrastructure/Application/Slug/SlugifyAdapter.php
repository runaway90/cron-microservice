<?php

namespace Choros\Infrastructure\Application\Slug;

use Choros\Application\SlugGenerator;
use Cocur\Slugify\Slugify;

class SlugifyAdapter implements SlugGenerator
{
    /** @var Slugify */
    private $slugify;

    public function generateFrom(string $string): string
    {
        return $this->slugify->slugify($string);
    }

    /**
     * SlugifyAdapter constructor.
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
}
