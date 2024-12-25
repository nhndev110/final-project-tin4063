<?php

namespace App\Services;

class AuthService
{
  public static function login(string $email, string $password)
  {
    $user = UserService::findUserByEmail($email);
    if ($user !== null && password_verify($password, $user['password'])) {
      $_SESSION['user'] = [
        'full_name' => $user['full_name'],
        'username' => $user['username'],
        'email' => $user['email'],
      ];
      return true;
    }

    return false;
  }

  public static function signin(
    $full_name,
    $username,
    $password,
    $email
  ) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    UserService::createUser([
      "full_name" => $full_name,
      "username" => $username,
      "password" => $password,
      "email" => $email,
    ]);

    $_SESSION["user"] = [
      "full_name" => $full_name,
      "username" => $username,
      "email" => $email,
    ];
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
