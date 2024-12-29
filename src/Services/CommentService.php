<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\User;

class CommentService
{
  public static function getCommentsByPostID(int $post_id)
  {
    $comments = Comment::getByPostID($post_id);

    foreach ($comments as &$comment) {
      $comment['user'] = User::find($comment['user_id']);
    }

    return $comments;
  }

  public static function countCommentsByPostID(int $post_id)
  {
    return Comment::countByPostID($post_id)[0]['COUNT(*)'] ?? 0;
  }

  public static function createComment(int $user_id, int $post_id, string $content): int
  {
    return Comment::create([
      "user_id" => $user_id,
      "post_id" => $post_id,
      "content" => $content,
    ]);
  }
}
