<?php

namespace App\Controllers;

class AccountController
{
  public function login()
  {
    view("account/login");
  }

  public function signup()
  {
    view("account/signup");
  }

  public function profile()
  {
    view("account/profile");
  }
}
