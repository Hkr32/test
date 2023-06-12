<?php

namespace App\Http;

final readonly class Request
{
    public function __construct(
        private array $uri,
        private array $request,
        private array $cookie,
        private array $files,
        private array $server,
    ) {}

    public static function capture(): self
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->uri[$key] ?? $default;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->request[$key] ?? $default;
    }

    public function cookie(string $key, mixed $default = null): mixed
    {
        return $this->cookie[$key] ?? $default;
    }

    public function path(): string
    {
        $uriComponents = parse_url($this->getRequestUri());

        $path = $uriComponents['path'];
        $path = preg_replace('~/{2,}~', '/', trim($path));
        $path = rtrim($path, '/');

        return $path ?: '/';
    }

    public function getRequestUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '';
    }
}
