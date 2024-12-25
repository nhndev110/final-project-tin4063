<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\FollowService;

class UserController
{
  public function follow($followed_id)
  {
    $follower_id = AuthService::user()['user_id'];
    FollowService::followUser($follower_id, $followed_id);
  }

  public function unfollow($followed_id)
  {
    $follower_id = AuthService::user()['user_id'];
    FollowService::unfollowUser($follower_id, $followed_id);
  }
}
