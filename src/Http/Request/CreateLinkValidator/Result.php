<?php

declare(strict_types=1);

namespace Project\Http\Request\CreateLinkValidator;

class Result
{
    /** @var bool */
    private $isValid;

    /** @var string[] */
    private $errorMessages;

    // ########################################

    public function __construct(
        bool $isValid,
        array $errorMessages
    ) {
        $this->isValid       = $isValid;
        $this->errorMessages = $errorMessages;
    }

    // ########################################

    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return string[]
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    // ########################################
}
