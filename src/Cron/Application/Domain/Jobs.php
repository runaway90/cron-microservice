<?php

namespace Cron\Application\Domain;

use Cron\Application\Job\Criteria;
use Cron\Domain\Jobs as DomainJobs;

interface Jobs extends DomainJobs
{
    public function getByCriteria(Criteria $criteria);
}
