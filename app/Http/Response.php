<?php

namespace App\Http;

final class Response
{
    private array $headers = [];

    private array $cookies = [];

    public function __construct(
        private readonly ?string $data = null,
    ) {}

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    public function setRedirect(string $url): self
    {
        $this->headers['Location'] = $url;

        return $this;
    }

    public function withCookie(array $cookie): self
    {
        $this->cookies = array_merge($this->cookies, $cookie);

        return $this;
    }

    private function sendHeaders(): void
    {
        foreach ($this->headers as $name => $value) {
            header($name.': '.$value);
        }

        foreach ($this->cookies as $name => $value) {
            setcookie($name, $value, [
                'expires' => 0,
                'path' => '/',
                'httponly' => true,
            ]);
        }
    }

    private function sendContent(): void
    {
        echo $this->data;
    }
}
