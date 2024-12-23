<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
  private static ?Post $postModel = null;

  private static function getPostModel(): Post
  {
    if (is_null(self::$postModel))
      self::$postModel = new Post();

    return self::$postModel;
  }

  public static function getAllPosts()
  {
    return self::getPostModel()->all();
  }

  public static function getPostById($id)
  {
    return self::getPostModel()->find(intval($id));
  }

  public static function createPost($post)
  {
    return self::getPostModel()->create($post);
  }

  public static function updatePost($id, $post)
  {
    return self::getPostModel()->update(intval($id), $post);
  }

  public static function deletePost($id)
  {
    return self::getPostModel()->delete(intval($id));
  }
}
