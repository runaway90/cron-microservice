<?php

namespace Cron\UserInterface\Symfony\Controller;

use Choros\Application\CommandBus;
use Cron\Application\Command\CreateNewJobCommand;
use Cron\Application\Domain\Jobs;
use Cron\Application\Job\Criteria;
use Cron\Domain\Exception\Exception;
use Cron\UserInterface\Symfony\Form\Type\JobFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class JobsController
{
    /** @var Jobs */
    private $jobs;

    /** @var CommandBus */
    private $commandBus;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * JobsController constructor.
     * @param Jobs $jobs
     * @param CommandBus $commandBus
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(Jobs $jobs, CommandBus $commandBus, FormFactoryInterface $formFactory)
    {
        $this->jobs = $jobs;
        $this->commandBus = $commandBus;
        $this->formFactory = $formFactory;
    }

    public function getJobsAction()
    {
        $criteria = new Criteria();
        $jobs = $this->jobs->getByCriteria($criteria);
        $formatted = [
            'active' => [],
            'unactive' => []
        ];

        foreach ($jobs as $job) {
            $tab = 'unactive';
            if ($job->isActive()) {
                $tab = 'active';
            }

            $formatted[$tab][] = (string)$job;
        }

        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @ApiDoc(
     *     description="Adds new job to the crontab",
     *     requirements=
     *     {
     *          {
     *              "name": "url",
     *              "dataType": "string",
     *              "requirement": "http(s)://url-to-server/path-to-script",
     *              "description": "URL to the resource that will by notified"
     *          },
     *          {
     *              "name": "expression",
     *              "dataType": "string",
     *              "requirement": "Crontab format",
     *              "description": "Time expression when the url should be notified"
     *          },
     *     }
     * )
     */
    public function postJobAction(Request $request)
    {
        $request->setRequestFormat('json');
        $command = new CreateNewJobCommand();
        $form = $this->formFactory->create(JobFormType::class, $command);
        $form->handleRequest($request);
        if ($form->isValid()) {
            try {
                $this->commandBus->handle($command);
            } catch (Exception $e) {
                return new JsonResponse(['status' => 'exception', 'error' => $e->getMessage()]);
            }

            return new JsonResponse(['status' => 'success']);
        }

        $formatted = [];
        $errors = $form->getErrors(true);
        while ($errors->valid()) {
            $error = $errors->current();
            $formatted[$error->getOrigin()->getName()] = $error->getMessage();
            $errors->next();
        }

        return new JsonResponse(['status' => 'error', 'errors' => $formatted]);
    }
}
