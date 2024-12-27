<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Like extends BaseModel
{
  protected string $table = "likes";

  public static function countByPostID($post_id)
  {
    $sql = "SELECT COUNT(*) as total FROM likes WHERE post_id = ?";
    return DB::query($sql, [$post_id])[0]['total'] ?? 0;
  }

  public static function findByPostIDAndUserID($post_id, $user_id)
  {
    $sql = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
    return DB::query($sql, [$post_id, $user_id]);
  }

  public static function deleteByPostIDAndUserID($post_id, $user_id)
  {
    $sql = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
    return DB::execute($sql, [$post_id, $user_id]);
  }
}
