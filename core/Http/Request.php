<?php

declare(strict_types=1);

namespace Core\Http;

class Request
{
    public const METHOD_GET  = 'GET';
    public const METHOD_POST = 'POST';

    /** @var string */
    private $method;

    /** @var string */
    private $uri;

    /** @var array */
    private $body;

    // ########################################

    public function __construct(
        string $method,
        string $uri,
        array $body = []
    ) {
        $this->method = $method;
        $this->uri    = $uri;
        $this->body   = $body;
    }

    // ########################################

    public function isMethodGet(): bool
    {
        return $this->method === self::METHOD_GET;
    }

    public function isMethodPost(): bool
    {
        return $this->method === self::METHOD_POST;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    // ########################################

    public function getUri(): string
    {
        return $this->uri;
    }

    // ########################################

    public function getBody(): array
    {
        return $this->body;
    }

    // ########################################
}
