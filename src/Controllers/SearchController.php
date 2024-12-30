<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\SearchService;

class SearchController
{
  public function index()
  {
    AuthService::checkAuthentication();

    $query = $_GET['q'] ?? '';
    $users = SearchService::searchUser($query);
    return view('Search/index', [
      'users' => $users
    ]);
  }
}
