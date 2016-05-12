<?php

namespace TestApp\Application\Anime;

use TestApp\Domain\Anime;
use TestApp\Domain\Name;

interface Storage
{
    public function save(Anime $anime);

    public function remove(Anime $anime);

    public function hasAnimeWithName(Name $name);

    /**
     * @param Name $name
     * @return Anime
     */
    public function fetchByName(Name $name): Anime;
    /**
     * @param string $slug
     * @return Anime
     */
    public function fetchBySlug($slug): Anime;

    public function fetchByCriteria(Criteria $criteria): array;

    public function count();
}
