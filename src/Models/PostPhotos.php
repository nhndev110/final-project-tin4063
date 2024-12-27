<?php

namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB;

class PostPhotos extends BaseModel
{
  protected string $table = "post_photos";

  public static function createMultiplePhotos($post_id, $photos)
  {
    $sql = "INSERT INTO post_photos (post_id, photo) VALUES ";
    $values = [];
    foreach ($photos as $photo) {
      $values[] = "($post_id, '$photo')";
    }
    $sql .= implode(", ", $values);
    return DB::execute($sql);
  }

  public static function getByPostID($post_id)
  {
    $sql = "SELECT * FROM post_photos WHERE post_id = ?";
    return DB::query($sql, [$post_id]);
  }
}
