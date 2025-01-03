<?php

namespace App\Services;

class AuthService
{
  public static function login(string $email, string $password): bool
  {
    $user = UserService::findUserByEmail($email);
    if ($user !== null && password_verify($password, $user['password'])) {
      $_SESSION['user'] = [
        'id' => $user['id'],
        'full_name' => $user['full_name'],
        'username' => $user['username'],
        'email' => $user['email'],
        'profile_picture' => $user['profile_picture'],
      ];
      return true;
    }

    return false;
  }

  public static function signup(
    $full_name,
    $username,
    $password,
    $email
  ) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $user_id = UserService::createUser([
      "full_name" => $full_name,
      "username" => $username,
      "password" => $password,
      "email" => $email,
    ]);

    if ($user_id === 0) {
      return false;
    } else {
      $_SESSION["user"] = [
        "id" => $user_id,
        "full_name" => $full_name,
        "username" => $username,
        "email" => $email,
      ];
      return true;
    }
  }

  public static function logout()
  {
    unset($_SESSION['user']);
  }

  public static function user()
  {
    return $_SESSION['user'] ?? null;
  }

  public static function isLoggedIn()
  {
    return isset($_SESSION['user']);
  }

  public static function checkAuthentication()
  {
    return isset($_SESSION['user']) ?: redirect('/login');
  }
}
