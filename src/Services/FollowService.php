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

  public static function followUser($follower_id, $followed_id)
  {
    return Follow::create([
      "follower_id" => intval($follower_id),
      "followed_id" => intval($followed_id),
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

  public static function getFollowerCount($user_id): int
  {
    return Follow::getFollowerCountByFollowedID(intval($user_id))[0]['cnt'] ?? 0;
  }

  public static function getFollowedCount($user_id): int
  {
    return Follow::getFollowedCountByFollowerID(intval($user_id))[0]['cnt'] ?? 0;
  }
}
