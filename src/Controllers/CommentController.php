<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\CommentService;
use App\Services\PostService;

class CommentController
{
  public function create($post_id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_POST['user_id'];
      $content = $_POST['content'];
      $created_at = date("Y-m-d H:i:s");

      CommentService::createComment($user_id, $post_id, $content, $created_at);
    }
  }
}
