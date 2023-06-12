<?php

namespace App\Http;

use App\Application;
use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;

readonly final class Router
{
    public function __construct(
        private Request $request,
        private array $routes,
    ) {}

    public function dispatch(): Response
    {
        $controller = $this->resolveCurrentRoute();

        return $controller($this->request);
    }

    private function resolveCurrentRoute(): callable
    {
        $path = $this->request->path();

        if (empty($this->routes[$path])) {
            throw new NotFoundHttpException(sprintf('The route "%s" could not be found.', $path));
        }

        $action = $this->routes[$path];

        return is_string($action)
            ? $this->makeController($action)
            : [$this->makeController($action[0]), $action[1]];
    }

    private function makeController(string $class): Controller
    {
        return new $class(Application::instance());
    }
}
