<?php

namespace App\View;

use App\Application;
use App\Exceptions\NotFoundViewException;

final readonly class View
{
    private const EXT = '.php';

    public function __construct(
        private string $path
    ) {}

    public function render(string $name, array $args = []): string
    {
        return $this->renderTemplate($this->getPathByName('app'), [
            'content' => $this->renderTemplate($this->getPathByName($name), $args),
            'config' => Application::instance()->config['app'],
        ]);
    }

    private function renderTemplate(string $path, array $args): string
    {
        if (!file_exists($path)) {
            throw new NotFoundViewException($path);
        }

        ob_start();

        $this->includeTemplate($path, $args);

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    private function includeTemplate(string $_path, array $args = []): void
    {
        unset($args['_path']);

        extract($args);

        require $_path;
    }

    private function safe(string|int|float $value = ''): string
    {
        return htmlspecialchars(addslashes($value));
    }

    private function getPathByName($name): string
    {
        return $this->path.'/'.$this->cleanPath($name).self::EXT;
    }

    private function cleanPath(string $path): string
    {
        return str_replace(['../', './', '.php'], '', trim($path));
    }
}
