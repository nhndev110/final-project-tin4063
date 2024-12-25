<?php

namespace App\Services;

use App\Models\User;

class UserService
{
  public static function getAllUsers()
  {
    return User::all();
  }

  public static function findUserByEmail(string $email)
  {
    return User::findByEmail($email);
  }

  public static function getUserById($id)
  {
    return User::find(intval($id));
  }

  public static function createUser($user)
  {
    return User::create($user);
  }

  public static function updateUser($id, $user)
  {
    return User::update(intval($id), $user);
  }

  public static function deleteUser($id)
  {
    return User::delete(intval($id));
  }
}
