<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Response;

abstract class Controller
{
    public function __construct(
        protected readonly Application $app,
    ) {}

    protected function render(string $name, array $args = []): Response
    {
        $content = $this->app->view->render($name, $args);

        return new Response($content);
    }

    protected function redirect(string $to): Response
    {
        return (new Response)->setRedirect($to);
    }

    protected function error(string $message): Response
    {
        return $this->render('error', [
            'message' => $message,
        ]);
    }
}
