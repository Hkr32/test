<?php

require __DIR__.'/vendor/autoload.php';

set_exception_handler(static function(Throwable $e) {
    echo 'Exception: '.$e->getMessage()."\n";
});

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

try {
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD']);
} catch (Dotenv\Exception\ValidationException $e) {
    exit('The application is not installed, see readme.'."\n");
}

if (!function_exists('env')) {
    function env(string $key, mixed $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

return require __DIR__.'/config.php';
