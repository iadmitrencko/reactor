<?php

namespace Project\Http\Controller;

class Link
{
    /** @var \Core\View */
    private $view;

    /** @var \Core\Http\Request */
    private $request;

    /** @var \Project\Link\Entity\Factory */
    private $entityFactory;

    /** @var \Project\Link\Storage */
    private $storage;

    /** @var \Project\Http\Controller\NotFound */
    private $notFoundController;

    /** @var \Core\Http\Redirect */
    private $redirect;

    /** @var \Project\Http\Request\CreateLinkValidator */
    private $createLinkValidator;

    // ########################################

    public function __construct(
        \Core\View $view,
        \Core\Http\Request $request,
        \Project\Link\Entity\Factory $entityFactory,
        \Project\Link\Storage $storage,
        \Project\Http\Controller\NotFound $notFoundController,
        \Core\Http\Redirect $redirect,
        \Project\Http\Request\CreateLinkValidator $createLinkValidator
    ) {
        $this->view                = $view;
        $this->request             = $request;
        $this->entityFactory       = $entityFactory;
        $this->storage             = $storage;
        $this->notFoundController  = $notFoundController;
        $this->redirect            = $redirect;
        $this->createLinkValidator = $createLinkValidator;
    }

    // ########################################

    public function show(): void
    {
        $this->view->render('page/link.php');
    }

    public function create(): void
    {
        $validationResult = $this->createLinkValidator->validateRequestData($this->request->getBody());
        if (!$validationResult->isValid()) {
            $this->view->render(
                'page/link.php',
                [
                    'errorMessages' => $validationResult->getErrorMessages(),
                ]
            );
        }

        $entity = $this->entityFactory->create(
            $this->request->getBody()['target_link'],
            new \DateTime($this->request->getBody()['expiration_date'])
        );

        $this->storage->set($entity);

        $this->view->render(
            'page/link.php',
            [
                'shortLink' => $entity->getShortLink(),
            ]
        );
    }

    public function redirect(): void
    {
        $hash = trim($this->request->getUri(), '/');

        $entity = $this->storage->findByHash($hash);
        if ($entity === null) {
            $this->notFoundController->showNotFoundPage();

            return;
        }

        if ($entity->isExpired()) {
            $this->view->render(
                'page/error.php',
                [
                    'message' => 'Link is expired.',
                ]
            );

            return;
        }

        $entity->increaseRedirectsCount();
        $this->storage->set($entity);

        $this->redirect->to($entity->getTargetLink());
    }

    // ########################################
}
