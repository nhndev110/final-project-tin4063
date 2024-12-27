<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\FollowService;
use App\Services\PostService;
use App\Services\UserService;

class UserController
{
  public function profile(string $username)
  {
    AuthService::checkAuthentication();

    return view("Account/profile", [
      'user' => UserService::findUserByUsername($username),
      'posts' => PostService::getAllPostsByUsername($username),
    ]);
  }

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
