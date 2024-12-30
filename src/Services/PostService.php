<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostPhotos;
use App\Models\User;

class PostService
{
  public static function getAllPostsByUsername(string $username)
  {
    $user = User::findByUsername($username);
    $posts = Post::getByUserID($user['id']);

    $posts = array_filter($posts, function ($post) use ($username) {
      return $username === AuthService::user()['username'] || $post['status'];
    });

    foreach ($posts as &$post) {
      $post['images'] = PostPhotos::getByPostID($post['id']);
      $post['comments'] = CommentService::getCommentsByPostID($post['id']);
    }

    return $posts;
  }

  public static function getPostsByFollowedUsers($user_id)
  {
    $posts = Post::getByFollowedUsers(intval($user_id));

    foreach ($posts as &$post) {
      $post['user'] = UserService::getUserById($post['user_id']);
      $post['images'] = PostPhotos::getByPostID($post['id']);
      $post['comments'] = CommentService::getCommentsByPostID($post['id']);
    }

    return $posts;
  }

  public static function getImageByPostID($post_id)
  {
    return PostPhotos::getByPostID($post_id);
  }

  public static function getPostById($id)
  {
    return Post::find(intval($id));
  }

  public static function savePost(int $post_id, string $content, $status): int
  {
    if ($post_id !== 0) {
      Post::update($post_id, [
        "content" => $content,
        "status" => $status
      ]);

      return $post_id;
    } else {
      return Post::create([
        "user_id" => AuthService::user()['id'],
        "content" => $content,
        "status" => $status
      ]);
    }
  }

  public static function savePostPhotos($post_id, $photos)
  {
    return PostPhotos::createMultiplePhotos($post_id, $photos);
  }

  public static function deletePost($id)
  {
    return Post::delete(intval($id));
  }

  public static function likePost(int $id)
  {
    if (LikeService::isPostLiked($id)) {
      LikeService::deleteLike($id);
      return false;
    } else {
      LikeService::createLike($id);
      return true;
    }
  }
}
