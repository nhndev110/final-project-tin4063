<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Services\PostService;

class PostController extends Controller
{
  public function create()
  {
    AuthService::checkAuthentication();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $content = $_POST['content'];

      PostService::createPost([
        "title" => $title,
        "content" => $content
      ]);

      return redirect('/');
    }

    return view('Post\create', ['post' => []]);
  }

  public function delete($postId)
  {
    PostService::deletePost($postId);

    return redirect("/");
  }
}
