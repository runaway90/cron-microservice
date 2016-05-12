<?php

namespace TestApp\Application\Anime;

class Criteria
{
    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    const WHERE_EQUAL = 'equal';
    const WHERE_HAS = 'has';
    const WHERE_STARTS = 'starts';
    const WHERE_ENDS = 'ends';

    private $limit = null;

    private $orderBy = [];

    private $where = [];

    public function limit(int $limit = null)
    {
        $this->limit = $limit;
    }

    public function sortBy($field, $order = self::SORT_DESC)
    {
        $this->orderBy[$field] = $order;
    }

    public function name($value, $type = self::WHERE_HAS)
    {
        $this->where['name'] = [
            'value' => $value,
            'type' => $type
        ];
    }
}
