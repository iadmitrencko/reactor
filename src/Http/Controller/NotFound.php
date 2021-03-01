<?php

namespace Project\Http\Controller;

class NotFound
{
    /** @var \Core\View */
    private $view;

    // ########################################

    public function __construct(\Core\View $view)
    {
        $this->view = $view;
    }

    // ########################################

    public function showNotFoundPage(): void
    {
        $this->view->render(
            'page/error.php',
            [
                'message' => 'Page is not found.',
            ]
        );
    }

    // ########################################
}
