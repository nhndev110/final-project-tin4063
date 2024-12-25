<?php

namespace App\Controllers;

use App\Services\AuthService;

class HomeController
{
  public function index()
  {
    AuthService::checkAuthentication();
    return view("Home/index");
  }
}
