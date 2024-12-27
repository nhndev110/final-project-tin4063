<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Follow extends BaseModel
{
  protected string $table = "follows";

  public static function unfollow($follower_id, $followed_id)
  {
    $sql = "delete from follows where follower_id = ? and followed_id = ?";
    return DB::execute($sql, [$follower_id, $followed_id]);
  }
}
