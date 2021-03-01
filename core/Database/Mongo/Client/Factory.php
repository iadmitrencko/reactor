<?php

declare(strict_types=1);

namespace Core\Database\Mongo\Client;

class Factory
{
    // ########################################

    public function create(
        string $host,
        int $port,
        ?string $databaseName = null,
        ?string $username = null,
        ?string $password = null
    ): \MongoDB\Client {
        $uri = "{$host}:{$port}";

        if (
            $databaseName !== null &&
            $username !== null &&
            $password !== null
        ) {
            $uri = "{$username}:{$password}@{$uri}/{$databaseName}";
        }

        return new \MongoDB\Client(
            "mongodb://{$uri}",
            [],
            [
                'typeMap' => [
                    'root'     => 'array',
                    'document' => 'array',
                ],
            ]
        );
    }

    // ########################################
}
