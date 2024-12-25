<?php

use App\Controllers\AccountController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\SearchController;
use App\Controllers\UserController;
use App\Core\Router;

$router = new Router();

$router->addRoute('/', fn() => redirect('/home'));
$router->addRoute('/home', [new HomeController(), 'index']);

$router->addRoute('/post/create', [new PostController(), 'create']);
$router->addRoute('/post/update/(\d+)', [new PostController(), 'update']);
$router->addRoute('/post/delete/(\d+)', [new PostController(), 'delete']);
$router->addRoute('/search', [new SearchController(), 'index']);

$router->addRoute('/profile', [new AccountController(), 'profile']);
$router->addRoute('/login', [new AccountController(), 'login']);
$router->addRoute('/signup', [new AccountController(), 'signup']);
$router->addRoute('/logout', [new AccountController(), 'logout']);

$router->addRoute('/follow/create/(\d+)', [new UserController(), 'follow']);
$router->addRoute('/follow/delete/(\d+)', [new UserController(), 'unfollow']);
$router->addRoute('/post/(\d+)/comment/create', [new CommentController(), 'create']);
