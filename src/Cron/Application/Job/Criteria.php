<?php

namespace Cron\Application\Job;

class Criteria
{
    private $limit = null;

    private $offset = 0;

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
}
