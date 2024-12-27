<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\SearchService;

class SearchController
{
  public function index()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $full_name = $_POST['user_id'] ?? null;
      $username = $_POST['user_id'] ?? null;

      $users = [];
      if ($full_name || $username) {
        $user = SearchService::searchUser($full_name, $username);
        if ($user) {
          $users[] = $user;
        }
      }
      return view('Search/index', [
        'users' => $users,
        'full_name' => $full_name,
        'username' => $username
      ]);
    }
    return view('Search/index');
  }
}
