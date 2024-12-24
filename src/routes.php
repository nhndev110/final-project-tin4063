<?php

use App\Controllers\AccountController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\SearchController;
use App\Core\Router;

$router = new Router();

$router->addRoute('/', fn() => redirect('/home'));
$router->addRoute('/home', [new HomeController(), 'index']);

$router->addRoute('/post', [new PostController(), 'index']);
$router->addRoute('/post/index', [new PostController(), 'index']);
$router->addRoute('/post/show/(\d+)', [new PostController(), 'show']);
$router->addRoute('/post/create', [new PostController(), 'create']);
$router->addRoute('/post/update/(\d+)', [new PostController(), 'update']);
$router->addRoute('/post/delete/(\d+)', [new PostController(), 'delete']);

$router->addRoute('/search', [new SearchController(), 'index']);

$router->addRoute('/login', [new AccountController(), 'login']);
$router->addRoute('/signup', [new AccountController(), 'signup']);
$router->addRoute('/profile', [new AccountController(), 'profile']);
