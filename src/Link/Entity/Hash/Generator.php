<?php

declare(strict_types=1);

namespace Project\Link\Entity\Hash;

class Generator
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 5;

    private const MAX_TRY_COUNT = 5;

    /** @var \Project\Link\Storage */
    private $storage;

    // ########################################

    public function __construct(\Project\Link\Storage $storage)
    {
        $this->storage = $storage;
    }

    // ########################################

    public function generateUnique(): string
    {
        for ($i = 0; $i < self::MAX_TRY_COUNT; $i++) {
            $hash = $this->getRandomString(
                rand(self::MIN_LENGTH, self::MAX_LENGTH)
            );

            if ($this->storage->findByHash($hash) === null) {
                return $hash;
            }
        }

        throw new \LogicException('Cannot generate unique hash.');
    }

    private function getRandomString(int $length): string
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    // ########################################
}
