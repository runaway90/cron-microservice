<?php

namespace TestApp\Application\Handler;

use TestApp\Application\Anime\Storage;
use TestApp\Application\Command\CreateNewAnimeCommand;
use TestApp\Domain\Anime;
use TestApp\Domain\Name;

class CreateNewAnimeHandler
{
    /** @var Storage */
    private $animeStorage;

    function handle(CreateNewAnimeCommand $createNewAnime)
    {
        $animeName = new Name($createNewAnime->name);
        $anime = new Anime($animeName);

        $this->animeStorage->save($anime);
    }

    public function __construct(Storage $storage)
    {
        $this->animeStorage = $storage;
    }
}
