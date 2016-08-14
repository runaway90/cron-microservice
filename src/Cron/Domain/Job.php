<?php

namespace Cron\Domain;

use Cron\Domain\Job\CronExpression;
use Cron\Domain\Job\Url;

class Job
{
    /** @var CronExpression */
    private $cronExpression;

    /** @var Url */
    private $jobUrl;

    /** @var bool */
    private $active = false;

    /**
     * Job constructor.
     * @param CronExpression $cronExpression
     * @param $jobUrl
     */
    public function __construct(CronExpression $cronExpression, Url $jobUrl)
    {
        $this->cronExpression = $cronExpression;
        $this->jobUrl = $jobUrl;
    }

    /**
     * @return bool
     */
    public function shouldBeDone(): bool
    {
        return $this->cronExpression->shouldBeDone();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return (string)$this->jobUrl;
    }

    public function activate()
    {
        $this->active = true;
    }

    public function deactivate()
    {
        $this->active = false;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    public function __toString()
    {
        return (string)$this->cronExpression.' '.$this->getUrl();
    }
}
