<?php

namespace App\Controllers;

use App\Services\CommentService;

class CommentController
{
  public function index($post_id)
  {
    $comments = CommentService::getCommentsByPostID($post_id);
    return view('Post\comments', compact('comments'));
  }

  public function create($post_id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_POST['user_id'];
      $content = $_POST['content'];

      CommentService::createComment($user_id, $post_id, $content);

      echo json_encode([
        'post_id' => $post_id,
        'qty_comments' => CommentService::countCommentsByPostID($post_id),
      ]);
      return;
    }
  }
}
