<?php

namespace Cron\Application\Domain;

use Cron\Application\Job\Criteria;
use Cron\Domain\Job;
use Cron\Domain\Jobs as DomainJobs;

interface Jobs extends DomainJobs
{
    /**
     * @param Criteria $criteria
     * @return Job[]
     */
    public function getByCriteria(Criteria $criteria);
}
