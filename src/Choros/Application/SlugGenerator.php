<?php

namespace Choros\Application;

interface SlugGenerator
{
    /**
     * @param string $string
     * @return string
     */
    public function generateFrom(string $string): string;
}
