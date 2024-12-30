<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Services\LikeService;
use App\Services\PostService;
use App\Services\UploadService;
use App\Services\UserService;

class PostController extends Controller
{
  public function detail(int $post_id)
  {
    AuthService::checkAuthentication();

    $post = PostService::getPostById($post_id);
    $user = UserService::getUserById($post['user_id']);

    if ($user['username'] !== AuthService::user()['username'] && !$post['status']) {
      return redirect("/home");
    }

    return view('Post\detail', [
      'user' => $user,
      'post' => $post,
      'images' => PostService::getImageByPostID($post_id),
    ]);
  }

  public function create()
  {
    AuthService::checkAuthentication();

    return view('Post\create');
  }

  public function edit(int $post_id)
  {
    AuthService::checkAuthentication();

    return view('Post\edit', [
      'post' => PostService::getPostById($post_id),
      'images' => PostService::getImageByPostID($post_id),
    ]);
  }

  public function save()
  {
    AuthService::checkAuthentication();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $post_id = $_POST['post_id'] ?? 0;
      $content = $_POST['content'];
      $status = $_POST['status'];

      if (empty($content)) {
        return redirect_with_error("/posts/create", [
          'content' => 'Vui lòng nhập nội dung',
        ]);
      }

      if (strlen($status) === 0) {
        return redirect_with_error("/posts/create", [
          'status' => 'Vui lòng chọn trạng thái',
        ]);
      }

      $saved_post_id = PostService::savePost($post_id, $content, $status);

      if (!empty($_FILES['fileInput']) && $_FILES['fileInput']['error'][0] != 4) {
        $files = $_FILES['fileInput'];

        $files_name = UploadService::uploadMultipleFile($files, "/assets/images/posts/$saved_post_id");

        PostService::savePostPhotos($saved_post_id, $files_name);
      }

      if ($post_id == $saved_post_id) {
        echo json_encode(['post_id' => $saved_post_id]);
        return;
      } else {
        return redirect("/users/" . AuthService::user()['username']);
      }
    }

    return redirect("/posts/create");
  }

  public function delete(int $post_id)
  {
    AuthService::checkAuthentication();

    PostService::deletePost($post_id);

    echo json_encode(['status' => 'success']);
    return;
  }

  public function like(int $post_id)
  {
    AuthService::checkAuthentication();

    echo json_encode([
      'status' => PostService::likePost($post_id),
      'likes' => LikeService::countLikes($post_id),
    ]);
    return;
  }
}
