<?php

const ROOT_DIR = __DIR__.'/..';

require ROOT_DIR.'/vendor/autoload.php';

if (!file_exists(ROOT_DIR.'/config.php')) {
    exit('The application is not installed, run the installation script (see readme).');
}

$config = require ROOT_DIR.'/config.php';

$app = new App\Application(ROOT_DIR, $config);

$app->handle(new App\Http\Request)->send();
