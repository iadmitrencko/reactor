<?php

declare(strict_types=1);

namespace Core\Http;

class Redirect
{
    // ########################################

    public function to(string $uri, $responseCode = 303): void
    {
        header('Location: ' . $uri, true, $responseCode);
    }

    // ########################################
}
