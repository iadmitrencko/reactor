<?php

declare(strict_types=1);

namespace Project;

class Application
{
    /** @var \Core\Http\Request */
    private $request;

    /** @var \Project\Http\Controller\Index */
    private $indexController;

    /** @var \Project\Http\Controller\NotFound */
    private $notFoundController;

    /** @var \Project\Http\Controller\Link */
    private $linkController;

    // ########################################

    public function __construct(
        \Core\Http\Request $request,
        \Project\Http\Controller\Index $indexController,
        \Project\Http\Controller\NotFound $notFoundController,
        \Project\Http\Controller\Link $linkController
    ) {
        $this->request            = $request;
        $this->indexController    = $indexController;
        $this->notFoundController = $notFoundController;
        $this->linkController     = $linkController;
    }

    // ########################################

    public function process(): void
    {
        if (
            $this->request->isMethodGet() &&
            $this->request->getUri() === '/'
        ) {
            $this->indexController->show();

            return;
        }

        if (
            $this->request->isMethodGet() &&
            $this->request->getUri() === '/link/'
        ) {
            $this->linkController->show();

            return;
        }

        if (
            $this->request->isMethodPost() &&
            $this->request->getUri() === '/link/'
        ) {
            $this->linkController->create();

            return;
        }

        if (
            $this->request->isMethodGet() &&
            preg_match('/[a-z0-9]/', trim($this->request->getUri(), '/'))
        ) {
            $this->linkController->redirect();

            return;
        }

        $this->notFoundController->showNotFoundPage();
    }

    // ########################################
}
