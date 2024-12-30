<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Follow extends BaseModel
{
  protected string $table = "follows";

  public static function deleteByFollow($follower_id, $followed_id)
  {
    $sql = "DELETE FROM follows WHERE follower_id = ? AND followed_id = ?";
    return DB::execute($sql, [$follower_id, $followed_id]);
  }

  public static function findByFollow($follower_id, $followed_id)
  {
    $sql = "SELECT * FROM follows WHERE follower_id = ? AND followed_id = ?";
    return DB::query($sql, [$follower_id, $followed_id]);
  }
  public static function countByFollow($follower_id)
  {
    $sql = "SELECT COUNT(*) as total FROM follows WHERE follower_id = ?";
    return DB::query($sql, [$follower_id])[0]['total'] ?? 0;
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
