<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Search extends BaseModel
{
  protected string $table = "users";
  public static function findByName($full_name, $username)
  {
    $sql = "select * from users where full_name  = ? or username = ?";
    return DB::query($sql, [$full_name, $username]);
  }
}
