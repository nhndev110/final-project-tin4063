<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
  public static function getAllPosts()
  {
    return Post::all();
  }

  public static function getPostById($id)
  {
    return Post::find(intval($id));
  }

  public static function createPost($post)
  {
    return Post::create($post);
  }

  public static function updatePost($id, $post)
  {
    return Post::update(intval($id), $post);
  }

  public static function deletePost($id)
  {
    return Post::delete(intval($id));
  }
}
