<?php

namespace TestApp\Infrastructure\Application\Anime;

use Choros\Application\SlugGenerator;
use Doctrine\DBAL\Connection;
use TestApp\Application\Anime\Criteria;
use TestApp\Application\Anime\Storage as AnimeStorage;
use TestApp\Domain\Anime;
use TestApp\Domain\Anime\Description;
use TestApp\Domain\Anime\Description\Content;
use TestApp\Domain\Anime\Description\Status;
use TestApp\Domain\Anime\Description\Type;
use TestApp\Domain\Name;

class DBALStorage implements AnimeStorage
{
    /** @var Connection */
    private $connection;

    /** @var SlugGenerator */
    private $slugGenerator;

    public function save(Anime $anime)
    {
        $updateArray = [
            'type' => (string)$anime->getDescription()->getType(),
            'status' => (string)$anime->getDescription()->getStatus(),
            'description_content' => (string)$anime->getDescription()->getContent()
        ];

        if ($this->hasAnimeWithName($anime->getName())) {
            $this->connection->update('anime', $updateArray, [
                'name' => (string)$anime->getName()
            ]);
        } else {
            $this->connection->insert('anime', $updateArray + [
                    'name' => (string)$anime->getName(),
                    'slug' => (string)$this->slugGenerator->generateFrom((string)$anime->getName())
                ]);
        }
    }

    public function remove(Anime $anime)
    {
        $this->connection->delete('anime', [
            'name' => (string)$anime->getName(),
        ]);
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
        $qb = $this->connection->createQueryBuilder();

        $stmt = $qb
            ->select('*')
            ->from('anime', 'anime')
            ->where('anime.name = :name')
            ->setParameter('name', (string)$name)
            ->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $this->buildAnime($row);
    }

    public function fetchBySlug($slug): Anime
    {
        $qb = $this->connection->createQueryBuilder();

        $stmt = $qb
            ->select('*')
            ->from('anime', 'anime')
            ->where('anime.slug = :slug')
            ->setParameter('slug', $slug)
            ->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $this->buildAnime($row);
    }

    public function fetchByCriteria(Criteria $criteria): array
    {
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->select('*')
            ->from('anime', 'anime')
            ->setFirstResult($criteria->getOffset())
        ;

        if (!is_null($criteria->getLimit())) {
            $qb->setMaxResults($criteria->getLimit());
        }

        foreach ($criteria->getWhereClause() as $fieldName => $whereRow) {
            $value = $whereRow['value'];
            switch ($whereRow['type']) {
                default:
                case Criteria::WHERE_EQUAL:
                    $operator = '=';
                    break;
                case Criteria::WHERE_HAS:
                    $operator = 'LIKE';
                    $value = '%'.$value.'%';
                    break;
                case Criteria::WHERE_STARTS:
                    $operator = 'LIKE';
                    $value = $value.'%';
                    break;
                case Criteria::WHERE_ENDS:
                    $operator = 'LIKE';
                    $value = '%'.$value;
                    break;
            }

            $qb
                ->andWhere($fieldName.' '.$operator.' :'.$fieldName)
                ->setParameter($fieldName, $value)
            ;
        }

        $stmt = $qb->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = $this->buildAnime($row);
        }

        return $result;
    }

    public function count()
    {
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->select('count(*)')
            ->from('anime', 'anime');

        return $qb->execute()->fetchColumn();
    }

    protected function buildAnime(array $animeRow): Anime
    {
        $animeName = new Name($animeRow['name']);
        $anime = new Anime($animeName);

        $type = new Type($animeRow['type']);
        $status = new Status($animeRow['status']);

        $content = new Content($animeRow['description_content']);
        $description = new Description($type, $status, $content);

        $anime->updateDescription($description);

        return $anime;
    }

    public function __construct(Connection $connection, SlugGenerator $slugGenerator)
    {
        $this->connection = $connection;
        $this->slugGenerator = $slugGenerator;
    }
}
