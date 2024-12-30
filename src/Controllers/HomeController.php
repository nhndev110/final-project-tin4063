<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\PostService;

class HomeController
{
  public function index()
  {
    AuthService::checkAuthentication();

    return view("Home/index", [
      "posts" => PostService::getPostsByFollowedUsers(AuthService::user()['id']),
    ]);
  }
}
