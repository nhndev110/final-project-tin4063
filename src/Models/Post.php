<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Post extends BaseModel
{
  protected string $table = "posts";

  public static function getByUserID(string $user_id)
  {
    $sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
    return DB::query($sql, [$user_id]);
  }

  public static function getByFollowedUsers(string $user_id)
  {
    $sql = "SELECT * FROM posts
            WHERE `status` = 1
              AND user_id IN (
                SELECT followed_id FROM follows WHERE follower_id = ?
              )
            ORDER BY created_at DESC";
    return DB::query($sql, [$user_id]);
  }
}
