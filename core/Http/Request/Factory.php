<?php

declare(strict_types=1);

namespace Core\Http\Request;

class Factory
{
    // ########################################

    public function create(): \Core\Http\Request
    {
        return new \Core\Http\Request(
            strtoupper($_SERVER['REQUEST_METHOD']),
            rtrim($_SERVER['REQUEST_URI'], '/') . '/',
            $_POST
        );
    }

    // ########################################
}
