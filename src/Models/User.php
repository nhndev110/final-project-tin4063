<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;
use App\Services\AuthService;

class User extends BaseModel
{
  protected string $table = "users";

  public static function findByFullNameOrUsername($query)
  {
    $userLoggedInID = AuthService::user()['id'];
    $sql = "SELECT * FROM users
            WHERE (full_name LIKE ?
              OR username LIKE ?)
              AND id NOT IN ($userLoggedInID)
            ORDER BY id DESC LIMIT 10";
    return DB::query($sql, ["%$query%", "%$query%"]);
  }

  public static function findByEmail(string $email)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    return DB::query($sql, [$email])[0];
  }

  public static function findByUsername(string $username)
  {
    $sql = "SELECT * FROM users WHERE username = ?";
    return DB::query($sql, [$username])[0];
  }
}
