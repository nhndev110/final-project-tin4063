<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class Comment extends BaseModel
{
  protected string $table = "comments";

  public static function getByPostID(string $post_id)
  {
    $sql = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
    return DB::query($sql, [$post_id]);
  }
}
