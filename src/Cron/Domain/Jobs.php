<?php

namespace Cron\Domain;

use Cron\Domain\Job\Url;

interface Jobs
{
    public function add(Job $job);

    public function getByUrl(Url $url): Job;

    public function exists(Url $url): bool;

    public function remove(Job $job);
}
