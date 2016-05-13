<?php

namespace TestApp\UserInterface\Symfony\Controller;

use Choros\Application\CommandBus;
use TestApp\Application\Anime\Criteria;
use TestApp\Application\Anime\Storage;

class AnimeController
{
    /** @var Storage */
    private $animeStorage;

    /** @var CommandBus */
    private $commandBus;

    public function getListAction()
    {
        $criteria = new Criteria();
        $criteria->limit(20);
        $criteria->sortBy('name');

        $animeList = $this->animeStorage->fetchByCriteria($criteria);
    }

    /**
     * AnimeController constructor.
     * @param Storage $animeStorage
     * @param CommandBus $commandBus
     */
    public function __construct(Storage $animeStorage, CommandBus $commandBus)
    {
        $this->animeStorage = $animeStorage;
        $this->commandBus = $commandBus;
    }
}
