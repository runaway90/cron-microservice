<?php

namespace Cron\Application\Job;

class Criteria
{
    private $limit = null;

    private $offset = 0;

    private $conditions = [];

    public function limit($limit)
    {
        $this->limit = $limit;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return null|int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    public function onlyActive()
    {
        $this->conditions['active'] = 1;
    }

    public function onlyUnactive()
    {
        $this->conditions['active'] = 0;
    }
    
    public function getConditions()
    {
        return $this->conditions;
    }
}
