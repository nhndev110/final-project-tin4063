<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Search;

class SearchService
{
  public static function searchUser($query)
  {
    return Search::findByName($query) ?? [];
  }
}
