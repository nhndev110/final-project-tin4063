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

    $user = UserService::findUserByUsername($username);
    if (is_null($user)) {
      return redirect("/home");
    }

    return view("Account/profile", [
      'user' => $user,
      'posts' => PostService::getAllPostsByUsername($username),
      'follower_count' => FollowService::getFollowerCount($user['id']),
      'followed_count' => FollowService::getFollowedCount($user['id']),
    ]);
  }

  public function search()
  {
    AuthService::checkAuthentication();

    $query = $_GET['q'] ?? '';
    $users = UserService::findUserByFullNameOrUsername($query);
    return view('Search/index', [
      'users' => $users
    ]);
  }

  public function edit(string $username)
  {
    AuthService::checkAuthentication();

    return view("Account/edit", [
      'user' => UserService::findUserByUsername($username),
    ]);
  }

  public function follow($follower_id)
  {
    AuthService::checkAuthentication();

    if (FollowService::isFollowing($follower_id)) {
      FollowService::deleteFollow($follower_id);
      return redirect_back();
    } else {
      FollowService::createFollow(intval($follower_id));
      return redirect_back();
    }
  }

  public function update()
  {
    AuthService::checkAuthentication();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $full_name = $_POST["full_name"];
      $email = $_POST["email"];
      $profile_picture = $_FILES["profile_picture"];
      $bio = $_POST["bio"];

      if (empty($full_name) || empty($email)) {
        return redirect_with_error("/users/update", [
          "message" => "Vui lòng điền đầy đủ thông tin"
        ]);
      }

      if (UserService::findUserByEmail($email) !== null && $email !== AuthService::user()['email']) {
        return redirect_with_error("/users/" . AuthService::user()['username'], [
          "email" => "Email đã tồn tại"
        ]);
      }

      $user = AuthService::user();
      $user_id = $user['id'];

      $name_profile_picture = $_POST["old_profile_picture"] ?? NULL;
      if (!is_null($profile_picture) && $profile_picture['error'] === 0) {
        $name_profile_picture = UploadService::uploadFile($profile_picture, "/assets/images/users/$user_id");
        $_SESSION['user']['profile_picture'] = $name_profile_picture;
      }

      UserService::updateUser($user_id, [
        "full_name" => $full_name,
        "email" => $email,
        "profile_picture" => $name_profile_picture,
        "bio" => $bio,
      ]);

      return redirect("/users/{$user['username']}");
    } else {
      return redirect("/home");
    }
  }
}
