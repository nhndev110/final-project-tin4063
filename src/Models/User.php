<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class User extends BaseModel
{
  protected string $table = "users";

  public static function findByEmail(string $email)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    return DB::query($sql, [$email])[0] ?? null;
  }
}