<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\FollowService;
use App\Services\PostService;
use App\Services\UploadService;
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

  public function update()
  {
    AuthService::checkAuthentication();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $full_name = $_POST["full_name"];
      $username = $_POST["username"];
      $email = $_POST["email"];
      $profile_picture = $_FILES["profile_picture"];
      $bio = $_POST["bio"];

      if (empty($full_name) || empty($username) || empty($email)) {
        return redirect_with_error("/users/update", [
          "message" => "Vui lòng điền đầy đủ thông tin"
        ]);
      }

      if (UserService::findUserByUsername($username) !== null && $username !== AuthService::user()['username']) {
        return redirect_with_error("/users/" . AuthService::user()['username'], [
          "username" => "Tên người dùng đã tồn tại"
        ]);
      }

      if (UserService::findUserByEmail($email) !== null && $email !== AuthService::user()['email']) {
        return redirect_with_error("/users/" . AuthService::user()['username'], [
          "email" => "Email đã tồn tại"
        ]);
      }

      $user = AuthService::user();
      $user_id = $user['id'];

      $name_profile_picture = null;
      if ($profile_picture['error'] === 0) {
        $name_profile_picture = UploadService::uploadFile($profile_picture, "/assets/images/users/$user_id");
      }

      UserService::updateUser($user_id, [
        "full_name" => $full_name,
        "username" => $username,
        "email" => $email,
        "profile_picture" => $name_profile_picture,
        "bio" => $bio,
      ]);

      return redirect("/users/$username");
    } else {
      return redirect("/home");
    }
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
