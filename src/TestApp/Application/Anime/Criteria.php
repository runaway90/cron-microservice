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

    private $offset = 0;

    private $orderBy = [];

    private $where = [];

    public function limit(int $limit = null)
    {
        $this->limit = $limit;
    }

    public function offset(int $offset = 0)
    {
        $this->offset = $offset;
    }

    public function sortBy($field, $order = self::SORT_DESC)
    {
        $this->orderBy[$field] = $order;
    }

    public function name($value, $type = self::WHERE_EQUAL)
    {
        $this->where['name'] = [
            'value' => $value,
            'type' => $type
        ];
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getWhereClause()
    {
        return $this->where;
    }
}
