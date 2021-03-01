<?php

declare(strict_types=1);

namespace Core;

class View
{
    /** @var string */
    private $viewBasePath;

    /** @var string */
    private $layout;

    // ########################################

    public function __construct(
        string $viewBasePath,
        string $layout
    ) {
        $this->viewBasePath = rtrim($viewBasePath, '/') . '/';
        $this->layout       = ltrim($layout, '/');
    }

    // ########################################

    public function render(
        string $pagePath,
        array $vars = []
    ): void {
        ob_clean();

        if (!empty($vars)) {
            extract($vars);
        }

        $child = $this->viewBasePath . ltrim($pagePath, '/');

        include_once $this->viewBasePath . $this->layout;
    }

    // ########################################
}
