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

  public function follow($follow_id)
  {
    AuthService::checkAuthentication();

    if (FollowService::isFollow($follow_id)) {
      return FollowService::deleteFollow($follow_id);
    } else {
      return FollowService::createFollow(intval($follow_id));
    }
  }
}
