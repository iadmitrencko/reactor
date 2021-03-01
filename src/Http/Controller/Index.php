<?php

namespace Project\Http\Controller;

class Index
{
    /** @var \Core\View */
    private $view;

    /** @var \Project\Link\Storage */
    private $storage;

    // ########################################

    public function __construct(
        \Core\View $view,
        \Project\Link\Storage $storage
    ) {
        $this->view    = $view;
        $this->storage = $storage;
    }

    // ########################################

    public function show(): void
    {
        $this->view->render(
            'page/index.php',
            [
                'links' => $this->storage->getAll(),
            ]
        );
    }

    // ########################################
}
