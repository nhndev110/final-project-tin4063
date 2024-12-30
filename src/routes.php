<?php

use App\Controllers\AccountController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Core\Router;

$router = new Router();

$router->addRoute('/', fn() => redirect('/home'));
$router->addRoute('/home', [new HomeController(), 'index']);

$router->addRoute('/posts/(\d+)/detail', [new PostController(), 'detail']);
$router->addRoute('/posts/create', [new PostController(), 'create']);
$router->addRoute('/posts/(\d+)/edit', [new PostController(), 'edit']);
$router->addRoute('/posts/save', [new PostController(), 'save']);
$router->addRoute('/posts/(\d+)/delete', [new PostController(), 'delete']);
$router->addRoute('/posts/(\d+)/comments/create', [new CommentController(), 'create']);
$router->addRoute('/posts/(\d+)/comments', [new CommentController(), 'index']);
$router->addRoute('/posts/(\d+)/like', [new PostController(), 'like']);

$router->addRoute('/search', [new UserController(), 'search']);
$router->addRoute('/users/(.*)', [new UserController(), 'profile']);
$router->addRoute('/users/(.*)/edit', [new UserController(), 'edit']);
$router->addRoute('/users/update', [new UserController(), 'update']);
$router->addRoute('/users/(\d+)/follow', [new UserController(), 'follow']);

$router->addRoute('/login', [new AccountController(), 'login']);
$router->addRoute('/signup', [new AccountController(), 'signup']);
$router->addRoute('/logout', [new AccountController(), 'logout']);
