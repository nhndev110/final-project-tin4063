<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\CommentService;

class CommentController
{
  public function index($post_id)
  {
    AuthService::checkAuthentication();

    $comments = CommentService::getCommentsByPostID($post_id);
    return view('Post\comments', compact('comments'));
  }

  public function create($post_id)
  {
    AuthService::checkAuthentication();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_POST['user_id'];
      $content = $_POST['content'];

      if (empty(trim($content))) {
        return;
      }

      CommentService::createComment($user_id, $post_id, $content);

      echo json_encode([
        'post_id' => $post_id,
        'qty_comments' => CommentService::countCommentsByPostID($post_id),
      ]);
      return;
    }
  }
}
