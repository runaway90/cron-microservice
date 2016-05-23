<?php

namespace TestApp\Application\Handler;

use TestApp\Application\Anime\Storage;
use TestApp\Application\Command\CreateNewAnimeCommand;
use TestApp\Domain\Anime;
use TestApp\Domain\Anime\Description;
use TestApp\Domain\Anime\Description\Content;
use TestApp\Domain\Anime\Description\Status;
use TestApp\Domain\Anime\Description\Type;
use TestApp\Domain\Name;

class CreateNewAnimeHandler
{
    /** @var Storage */
    private $animeStorage;

    function handle(CreateNewAnimeCommand $createNewAnime)
    {
        $animeName = new Name($createNewAnime->name);
        $anime = new Anime($animeName);

        $type = new Type($createNewAnime->type);
        $status = new Status($createNewAnime->status);

        $content = new Content($createNewAnime->content);
        $description = new Description($type, $status, $content);

        $anime->updateDescription($description);

        $this->animeStorage->save($anime);
    }

    public function __construct(Storage $storage)
    {
        $this->animeStorage = $storage;
    }
}
