<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
  public static function createComment(int $user_id, int $post_id, string $content, $created_at)
  {
    return Comment::create([
      "user_id" => $user_id,
      "post_id" => $post_id,
      "content" => $content,
      "created_at" => $created_at,
    ]);
  }
}
