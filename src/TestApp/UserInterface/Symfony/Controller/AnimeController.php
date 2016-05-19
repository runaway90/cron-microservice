<?php

namespace TestApp\UserInterface\Symfony\Controller;

use Choros\Application\CommandBus;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use TestApp\Application\Anime\Criteria;
use TestApp\Application\Anime\Storage;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use TestApp\Application\Command\CreateNewAnimeCommand;
use TestApp\UserInterface\Symfony\Form\CreateNewAnimeFormType;

/**
 * Class AnimeController
 * @package TestApp\UserInterface\Symfony\Controller
 */
class AnimeController
{
    /** @var Storage */
    private $animeStorage;

    /** @var CommandBus */
    private $commandBus;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * @Rest\View()
     * @ApiDoc(
     *     resource=true,
     *     description="Get the anime list",
     *     requirements={
     *          {"name"="_format", "dataType"="string", "required"=false, "description"="Response format", "requirement": "xml|json"}
     *     }
     * )
     */
    public function getListAction(Request $request)
    {
        $criteria = new Criteria();
        $criteria->limit(20);
        $criteria->sortBy('name');

        $animeList = $this->animeStorage->fetchByCriteria($criteria);

        return $animeList;
    }

    /**
     * @Rest\View()
     * @ApiDoc(
     *     resource=true,
     *     description="Create new Anime",
     *     requirements={
     *          {"name"="_format", "dataType"="string", "required"=false, "description"="Response format", "requirement": "xml|json"}
     *     },
     *     parameters={
     *          {"name"="name", "dataType"="string", "required"=true, "description"="Anime name"},
     *          {"name"="status", "dataType"="string", "required"=true, "description"="Anime name"},
     *          {"name"="type", "dataType"="string", "required"=true, "description"="Anime name"},
     *          {"name"="content", "dataType"="string", "required"=true, "description"="Anime name"}
     *     }
     * )
     */
    public function postAnimeAction(Request $request)
    {
        $animeCommand = new CreateNewAnimeCommand();
        $form = $this->formFactory->create(CreateNewAnimeFormType::class, $animeCommand);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->commandBus->handle($animeCommand);

            return ['ok' => true];
        }

        return ['errors' => (string)$form->getErrors()];
    }

    /**
     * AnimeController constructor.
     * @param Storage $animeStorage
     * @param CommandBus $commandBus
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(Storage $animeStorage, CommandBus $commandBus, FormFactoryInterface $formFactory)
    {
        $this->animeStorage = $animeStorage;
        $this->commandBus = $commandBus;
        $this->formFactory = $formFactory;
    }
}
