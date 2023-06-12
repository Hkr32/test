<?php

namespace App;

use App\Database\Database;
use App\Exceptions\NotInitializedAppException;
use App\Http\Request;
use App\Http\Response;
use App\Http\Router;
use App\View\View;

final class Application
{
    public readonly View $view;

    public readonly Database $db;

    private static ?Application $app = null;

    public function __construct(
        public readonly string $workDir,
        public readonly array $config,
    ) {
        $this->view = new View($workDir.$config['views']['path']);

        $this->db = new Database(
            $config['db']['host'],
            $config['db']['name'],
            $config['db']['user'],
            $config['db']['password']
        );

        self::$app = $this;
    }

    public static function instance()
    {
        if (self::$app === null) {
            throw new NotInitializedAppException;
        }

        return self::$app;
    }

    public function handle(Request $request): Response
    {
        $response = $this->dispatchToRouter($request);

        return $response;
    }

    public function getName(): string
    {
        return $this->config['app']['name'];
    }

    private function dispatchToRouter(Request $request): Response
    {
        $router = new Router($request, $this->config['routes']);

        return $router->dispatch();
    }
}
