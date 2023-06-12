<?php

const ROOT_DIR = __DIR__.'/..';

$config = require ROOT_DIR.'/bootstrap.php';

$app = new App\Application(ROOT_DIR, $config);

$app->handle(App\Http\Request::capture())->send();
