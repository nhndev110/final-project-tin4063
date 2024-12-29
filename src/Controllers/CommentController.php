<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController
{
  public function index($post_id)
  {
    return CommentService::getCommentsByPostID($post_id);
  }

  public function create($post_id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_POST['user_id'];
      $content = $_POST['content'];
      if (empty(trim($content))) {
        return redirect_back();
      }
      CommentService::createComment($user_id, $post_id, $content);

      return redirect_back();
    }
  }
}
