<?php

declare(strict_types=1);

namespace Core\Database\Mongo;

class Manager extends \Doctrine\ODM\MongoDB\DocumentManager
{
    // ########################################

    public function __construct(
        ?\MongoDB\Client $client,
        \Doctrine\ODM\MongoDB\Configuration $config
    ) {
        parent::__construct($client, $config);
    }

    // ########################################
}
