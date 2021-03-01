<?php

declare(strict_types=1);

namespace Project\Link\Entity;

class Factory
{
    /** @var \Project\Link\Entity\Hash\Generator */
    private $hashGenerator;

    /** @var string */
    private $domain;

    // ########################################

    public function __construct(
        \Project\Link\Entity\Hash\Generator $hashGenerator,
        string $domain
    ) {
        $this->hashGenerator = $hashGenerator;
        $this->domain        = rtrim($domain, '/') . '/';
    }

    // ########################################

    public function create(string $targetLink, \DateTime $expirationDate): \Project\Link\Entity
    {
        $hash      = $this->hashGenerator->generateUnique();
        $shortLink = $this->domain . $hash;

        return new \Project\Link\Entity(
            $targetLink,
            $shortLink,
            $hash,
            $expirationDate,
            0
        );
    }

    // ########################################
}
