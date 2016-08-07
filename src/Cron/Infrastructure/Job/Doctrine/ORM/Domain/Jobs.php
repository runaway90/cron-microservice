<?php

namespace Cron\Infrastructure\Job\Doctrine\ORM\Domain;

use Cron\Domain\Exception\JobNotFoundException;
use Cron\Domain\Job;
use Cron\Domain\Job\Url;
use Cron\Domain\Jobs as JobsInterface;
use Doctrine\ORM\EntityManager;

class Jobs implements JobsInterface
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * Users constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Job $job
     */
    public function add(Job $job)
    {
        $this->entityManager->persist($job);
    }

    /**
     * @param Url $url
     * @return Job
     * @throws JobNotFoundException
     */
    public function getByUrl(Url $url): Job
    {
        $job = $this->entityManager->getRepository(Job::class)->findOneBy([
            'url' => $url
        ]);

        if (is_null($job)) {
            throw JobNotFoundException::byUrl($url);
        }
        
        return $job;
    }

    /**
     * @param Url $url
     * @return bool
     */
    public function exists(Url $url): bool
    {
        $job = $this->entityManager->getRepository(Job::class)->findOneBy([
            'url' => $url
        ]);

        return !is_null($job);
    }

    /**
     * @param Job $job
     */
    public function remove(Job $job)
    {
        $this->entityManager->remove($job);
    }
}
