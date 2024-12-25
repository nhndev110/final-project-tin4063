<?php

namespace App\Controllers;

use App\Services\AuthService;

class AccountController
{
  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];

      if (AuthService::login($email, $password)) {
        return redirect("/home");
      }
    }

    return view("Account/login");
  }

  public function signup()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $full_name = $_POST["full_name"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      $confirm_password = $_POST["confirm_password"];
      $email = $_POST["email"];

      if ($password !== $confirm_password) {
        return;
      }

      AuthService::signin(
        $full_name,
        $username,
        $password,
        $email
      );

      return redirect("/home");
    }

    return view("Account/signup");
  }

  public function logout()
  {
    AuthService::checkAuthentication();
    AuthService::logout();
    return redirect("/login");
  }

  public function profile()
  {
    AuthService::checkAuthentication();
    return view("Account/profile");
  }
}
