<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Response;

abstract class Controller
{
    public function __construct(
        protected readonly Application $app,
    ) {}

    public function render(string $name, array $args = []): Response
    {
        $content = $this->app->view->render($name, $args);

        return new Response($content);
    }

    public function redirect(string $to): Response
    {
        return new Response();
    }
}
