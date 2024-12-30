<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\UserService;

class AccountController
{
  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];

      if (empty($email) || empty($password)) {
        return redirect_with_error_and_input("/login", [
          "message" => "Email hoặc mật khẩu không được để trống"
        ], [
          "email" => $email
        ]);
      }

      if (AuthService::login($email, $password)) {
        return redirect("/home");
      } else {
        return redirect_with_error_and_input("/login", [
          "message" => "Email hoặc mật khẩu không chính xác"
        ], [
          "email" => $email
        ]);
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

      if (empty($full_name) || empty($username) || empty($password) || empty($email)) {
        return redirect_with_error_and_input("/signup", [
          "message" => "Vui lòng điền đầy đủ thông tin"
        ], [
          "full_name" => $full_name,
          "username" => $username,
          "email" => $email
        ]);
      }

      if (UserService::findUserByUsername($username) !== null) {
        return redirect_with_error_and_input("/signup", [
          "username" => "Tên người dùng đã tồn tại"
        ], [
          "full_name" => $full_name,
          "email" => $email
        ]);
      }

      if (UserService::findUserByEmail($email) !== null) {
        return redirect_with_error_and_input("/signup", [
          "email" => "Email đã tồn tại"
        ], [
          "full_name" => $full_name,
          "username" => $username
        ]);
      }

      if ($password !== $confirm_password) {
        return redirect_with_error_and_input("/signup", [
          "confirm_password" => "Mật khẩu không khớp"
        ], [
          "full_name" => $full_name,
          "username" => $username,
          "email" => $email
        ]);
      }

      $isSignedUp = AuthService::signup(
        $full_name,
        $username,
        $password,
        $email
      );

      if (!$isSignedUp) {
        return redirect_with_error("/signup", [
          "message" => "Đăng ký thất bại"
        ]);
      }

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
}
