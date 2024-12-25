<?php

namespace App\Services;

use App\Models\Follow;

class FollowService
{
  public static function followUser(int $follower_id, $followed_id)
  {
    return Follow::create([
      "follower_id" => $follower_id,
      "followed_id" => $followed_id
    ]);
  }

  public static function unfollowUser($follower_id, $followed_id)
  {
    return Follow::unfolow($follower_id, $followed_id);
  }
}
