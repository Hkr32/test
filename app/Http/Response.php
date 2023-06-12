<?php

namespace App\Http;

final class Response
{
    private ?string $redirectTo = null;

    public function __construct(
        private readonly ?string $data = null,
    ) {}

    public function send(): void
    {
        if ($this->redirectTo) {
            // TODO WIP
        } else {
            echo $this->data;
        }
    }

    public function setRedirect(string $url): self
    {
        $this->redirectTo = $url;

        return $this;
    }

    public function withCookie(array $cookie): self
    {
        // TODO WIP

        return $this;
    }
}
