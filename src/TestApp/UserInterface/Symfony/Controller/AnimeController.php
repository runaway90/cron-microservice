<?php

namespace TestApp\UserInterface\Symfony\Controller;

use Choros\Application\CommandBus;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
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
     *     description="Get the anime list"
     * )
     */
    public function getListAction()
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
     *     description="Create new Anime"
     * )
     */
    public function postAnimeAction(Request $request)
    {
        $animeCommand = new CreateNewAnimeCommand();
        $form = $this->formFactory->create(CreateNewAnimeFormType::class, $animeCommand);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->commandBus->handle($animeCommand);
        } else {
            return $form->getErrors();
        }
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
