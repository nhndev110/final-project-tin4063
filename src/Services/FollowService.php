<?php

namespace App\Services;

use App\Models\Follow;

class FollowService
{
  public static function createFollow($followed_id)
  {
    return Follow::create([
      "follower_id" => intval(AuthService::user()['id']),
      "followed_id" => intval($followed_id),
    ]);
  }

  public static function isFollowing($followed_id)
  {
    return !empty(Follow::findByFollow(AuthService::user()['id'], $followed_id));
  }

  public static function deleteFollow($followed_id)
  {
    return Follow::deleteByFollow(AuthService::user()['id'], $followed_id);
  }

  // Lấy ra số người theo dõi bạn
  public static function getFollowerCount($user_id): int
  {
    return Follow::getFollowerCountByFollowedID(intval($user_id))[0]['cnt'] ?? 0;
  }

  // Lấy ra số người bạn đang theo dõi
  public static function getFollowedCount($user_id): int
  {
    return Follow::getFollowedCountByFollowerID(intval($user_id))[0]['cnt'] ?? 0;
  }
}
