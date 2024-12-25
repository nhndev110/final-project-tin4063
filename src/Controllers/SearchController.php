<?php

namespace App\Controllers;

use App\Services\AuthService;

class SearchController
{
  public function index()
  {
    AuthService::checkAuthentication();
    return view('Search/index');
  }
}
