<?php

namespace Cron\Domain\Job;

use Cron\CronExpression as BaseCronExpression;
use Cron\Domain\Job\Exception\InvalidTimeArgumentException;

class CronExpression
{
    /** @var string */
    private $expression;

    /**
     * CronExpression constructor.
     * @param string $expression
     * @throws InvalidTimeArgumentException
     */
    public function __construct(string $expression)
    {
        if (!BaseCronExpression::isValidExpression($expression)) {
            throw InvalidTimeArgumentException::fromString($expression);
        }
        
        $this->expression = $expression;
    }

    public function shouldBeDone()
    {
        $ce = BaseCronExpression::factory($this->expression);
        
        return $ce->isDue();
    }
    
    function __toString()
    {
        return $this->expression;
    }
}
