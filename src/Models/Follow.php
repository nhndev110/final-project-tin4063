<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Follow extends BaseModel
{
  protected string $table = "follows";

  public static function unfolow($follower_id, $followed_id)
  {
    $sql = "delete from follows where follower_id = ? and followed_id = ?";
    return DB::execute($sql, [$follower_id, $followed_id]);
  }

  public static function getFollowerCountByFollowedID(int $followed_id)
  {
    $sql = "SELECT COUNT(*) AS cnt FROM follows WHERE followed_id = ? GROUP BY followed_id";
    return DB::query($sql, [$followed_id]);
  }

  public static function getFollowedCountByFollowerID(int $follower_id)
  {
    $sql = "SELECT COUNT(*) AS cnt FROM follows WHERE follower_id = ? GROUP BY follower_id";
    return DB::query($sql, [$follower_id]);
  }
}
