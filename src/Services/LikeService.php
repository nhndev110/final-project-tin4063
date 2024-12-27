<?php

namespace App\Services;

use App\Models\Like;

class LikeService
{
  public static function createLike($post_id)
  {
    Like::create([
      "post_id" => $post_id,
      "user_id" => AuthService::user()['id']
    ]);
  }

  public static function isPostLiked($post_id)
  {
    return !empty(Like::findByPostIDAndUserID($post_id, AuthService::user()['id']));
  }

  public static function countLikes($post_id)
  {
    return Like::countByPostID($post_id);
  }

  public static function deleteLike($post_id)
  {
    Like::deleteByPostIDAndUserID($post_id, AuthService::user()['id']);
  }
}
