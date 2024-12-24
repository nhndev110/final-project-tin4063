<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\PostService;

class PostController extends Controller
{
  public function index()
  {
    $posts = PostService::getAllPosts();

    view('posts\post-list', ['posts' => $posts]);
  }

  public function show($postId)
  {
    $post = PostService::getPostById($postId);

    view('posts\post-form', ['post' => $post]);
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $content = $_POST['content'];

      PostService::createPost([
        "title" => $title,
        "content" => $content
      ]);

      redirect('/');
    }

    view('post\create', ['post' => []]);
  }

  public function update($postId)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $content = $_POST['content'];

      PostService::updatePost($postId, [
        "title" => $title,
        "content" => $content
      ]);

      redirect("/");
    }

    $post = PostService::getPostById($postId);
    view('posts\post-form', ['post' => $post]);
  }

  public function delete($postId)
  {
    PostService::deletePost($postId);

    redirect("/");
  }
}
