<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Search extends BaseModel
{
  protected string $table = "users";
  public static function findByName($query)
  {
    $sql = "SELECT * FROM users WHERE full_name LIKE ? OR username LIKE ?";
    return DB::query($sql, ["%$query%", "%$query%"]);
  }
}
