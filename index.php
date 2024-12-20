<?php

require_once __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/src/routes.php';

$uri = $_SERVER['REQUEST_URI'];

$router->match($uri);
