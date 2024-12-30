<?php

namespace App\Services;

use App\Models\Follow;

class FollowService
{
  public static function followUser($follower_id, $followed_id)
  {
    return Follow::create([
      "follower_id" => intval($follower_id),
      "followed_id" => intval($followed_id),
    ]);
  }

  public static function unfollowUser($follower_id, $followed_id)
  {
    return Follow::unfolow(intval($follower_id), intval($followed_id));
  }

  public static function getFollowerCount($user_id): int
  {
    return Follow::getFollowerCountByFollowedID(intval($user_id))[0]['cnt'] ?? 0;
  }

  public static function getFollowedCount($user_id): int
  {
    return Follow::getFollowedCountByFollowerID(intval($user_id))[0]['cnt'] ?? 0;
  }
}
