<?php

namespace TestApp\Infrastructure\Application\Anime;

use Doctrine\DBAL\Connection;
use TestApp\Application\Anime\Criteria;
use TestApp\Application\Anime\Storage as AnimeStorage;
use TestApp\Domain\Anime;
use TestApp\Domain\Name;

class DBALStorage implements AnimeStorage
{
    /** @var Connection */
    private $connection;

    public function save(Anime $anime)
    {
        if ($this->hasAnimeWithName($anime->getName())) {
            $this->connection->update('anime', [

            ], [
                'name' => (string)$anime->getName()
            ]);
        } else {

        }
    }

    public function remove(Anime $anime)
    {
        // TODO: Implement remove() method.
    }

    public function hasAnimeWithName(Name $name)
    {
        $qb = $this->connection->createQueryBuilder();

        $stmt = $qb
            ->select('*')
            ->from('anime', 'anime')
            ->where('anime.name = :name')
            ->setParameter('name', (string)$name)
            ->execute();

        return $stmt->rowCount() == 1;
    }

    public function fetchByName(Name $name): Anime
    {
        // TODO: Implement fetchByName() method.
    }

    public function fetchBySlug($slug): Anime
    {
        // TODO: Implement fetchBySlug() method.
    }

    public function fetchByCriteria(Criteria $criteria): array
    {
        // TODO: Implement fetchByCriteria() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

}
