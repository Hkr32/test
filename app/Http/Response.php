<?php

namespace App\Http;

class Response
{
    public function __construct(
        private readonly ?string $data = null,
    ) {}

    public function send()
    {
        echo $this->data;
    }
}
