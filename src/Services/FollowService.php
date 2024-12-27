<?php

namespace App\Services;

use App\Models\Follow;

class FollowService
{
  public static function createFollow($follow_id)
  {
    return Follow::create([
      "follow_id" => $follow_id,
      "user_id" => AuthService::user()['id']
    ]);
  }

  public static function isFollow($follow_id)
  {
    return !empty(Follow::findByFollow($follow_id, AuthService::user()['id']));
  }

  public static function deleteFollow($follow_id)
  {
    return Follow::deleteByFollow($follow_id, AuthService::user()['id']);
  }

  public static function countFollows($follower_id)
  {
    return Follow::countByFollow($follower_id);
  }
}
