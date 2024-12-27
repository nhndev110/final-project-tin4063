<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Search;

class SearchService
{
  public static function searchUser(int $full_name, $username)
  {
    return Search::findByName($full_name, $username);
  }
}
